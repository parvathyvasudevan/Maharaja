<?php
/**
 * includes/email.php
 * Centralized email handling for Maharaja Supermarket
 */

require_once __DIR__ . '/helpers.php';

/**
 * Send an HTML order confirmation email
 * 
 * @param int $order_id
 * @param PDO $pdo
 * @return bool
 */
function send_order_email($order_id, $pdo) {
    try {
        // 1. Fetch Order Details
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$order_id]);
        $order = $stmt->fetch();

        if (!$order) {
            error_log("Email Error: Order #$order_id not found.");
            return false;
        }

        // 2. Fetch Order Items
        $stmt_items = $pdo->prepare("SELECT oi.*, p.title_en, p.title_ro, p.image_url 
                                   FROM order_items oi 
                                   JOIN products p ON oi.product_id = p.id 
                                   WHERE oi.order_id = ?");
        $stmt_items->execute([$order_id]);
        $items = $stmt_items->fetchAll();

        $lang = $_SESSION['lang'] ?? 'en';
        $title_col = ($lang == 'ro') ? 'title_ro' : 'title_en';

        // 3. Prepare Email Content
        $to = $order['email'];
        $subject = "Order Confirmation - Maharaja Supermarket (#$order_id)";
        
        // --- HTML TEMPLATE ---
        $message = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <style>
                body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f4f4f4; }
                .wrapper { max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
                .header { background-color: #6ea622; color: #ffffff; padding: 30px; text-align: center; }
                .header h1 { margin: 0; font-size: 24px; }
                .content { padding: 30px; }
                .order-info { margin-bottom: 30px; border-bottom: 2px solid #f0f0f0; padding-bottom: 20px; }
                .items-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
                .items-table th { text-align: left; border-bottom: 2px solid #f0f0f0; padding: 10px; color: #888; text-transform: uppercase; font-size: 12px; }
                .items-table td { padding: 15px 10px; border-bottom: 1px solid #f9f9f9; }
                .totals { margin-left: auto; width: 250px; }
                .total-row { display: flex; justify-content: space-between; padding: 5px 0; }
                .total-row.grand-total { border-top: 2px solid #6ea622; margin-top: 10px; padding-top: 10px; font-weight: bold; color: #6ea622; font-size: 18px; }
                .footer { background: #fdfdfd; padding: 20px; text-align: center; font-size: 12px; color: #999; border-top: 1px solid #eee; }
                .address-box { background: #f9f9f9; padding: 15px; border-radius: 6px; margin-top: 20px; }
                .btn { display: inline-block; padding: 12px 25px; background-color: #6ea622; color: #fff; text-decoration: none; border-radius: 4px; font-weight: bold; margin-top: 20px; }
            </style>
        </head>
        <body>
            <div class='wrapper'>
                <div class='header'>
                    <h1>Order Received!</h1>
                </div>
                <div class='content'>
                    <p>Hello <strong>" . htmlspecialchars($order['name']) . "</strong>,</p>
                    <p>Thank you for shopping with us! Your order <strong>#$order_id</strong> has been successfully placed and is currently being processed.</p>
                    
                    <div class='order-info'>
                        <p style='margin: 0;'><strong>Date:</strong> " . date('d M Y, H:i', strtotime($order['created_at'])) . "</p>
                        <p style='margin: 0;'><strong>Payment Method:</strong> " . strtoupper($order['payment_method']) . "</p>
                    </div>

                    <table class='items-table'>
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th style='text-align: center;'>Qty</th>
                                <th style='text-align: right;'>Price</th>
                            </tr>
                        </thead>
                        <tbody>";
                        
        foreach ($items as $item) {
            $message .= "
                            <tr>
                                <td>" . htmlspecialchars($item[$title_col]) . "</td>
                                <td style='text-align: center;'>" . $item['quantity'] . "</td>
                                <td style='text-align: right;'>" . format_currency($item['price'] * $item['quantity']) . "</td>
                            </tr>";
        }

        $message .= "
                        </tbody>
                    </table>

                    <div class='totals'>
                        <div class='total-row'>
                            <span>Subtotal:</span>
                            <span>" . format_currency($order['subtotal_amount']) . "</span>
                        </div>
                        <div class='total-row'>
                            <span>Shipping:</span>
                            <span>" . format_currency($order['shipping_cost']) . "</span>
                        </div>
                        <div class='total-row' style='color: #888; font-size: 0.9em;'>
                            <span>Included TVA (9%):</span>
                            <span>" . format_currency($order['tax_amount']) . "</span>
                        </div>
                        <div class='total-row grand-total'>
                            <span>Total:</span>
                            <span>" . format_currency($order['total_amount']) . "</span>
                        </div>
                    </div>

                    <div class='address-box'>
                        <p style='margin: 0 0 5px 0;'><strong>Delivery Address:</strong></p>
                        <p style='margin: 0; color: #666; font-size: 14px;'>" . nl2br(htmlspecialchars($order['address'])) . "</p>
                    </div>

                    <p style='margin-top: 30px;'>We will notify you once your order is on its way. In the meantime, feel free to contact us if you have any questions.</p>
                </div>
                <div class='footer'>
                    &copy; " . date('Y') . " Maharaja Supermarket. All rights reserved.<br>
                    Strada Exemplu 123, București, Romania
                </div>
            </div>
        </body>
        </html>";

        // 4. Headers
        $from_email = "shop@maharajasupermarket.ro";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: Maharaja Supermarket <$from_email>" . "\r\n";
        $headers .= "Reply-To: $from_email" . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // 5. Send
        return @mail($to, $subject, $message, $headers);

    } catch (Exception $e) {
        error_log("Email Exception: " . $e->getMessage());
        return false;
    }
}
