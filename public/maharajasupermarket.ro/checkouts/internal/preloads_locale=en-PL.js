
    (function() {
      var cdnOrigin = "https://cdn.shopify.com";
      var scripts = ["/cdn/shopifycloud/checkout-web/assets/c1/polyfills.BVYsYAdG.js","/cdn/shopifycloud/checkout-web/assets/c1/app.CATVnQY0.js","/cdn/shopifycloud/checkout-web/assets/c1/locale-en.NFT7mTMc.js","/cdn/shopifycloud/checkout-web/assets/c1/page-Information.CFi0a8h3.js","/cdn/shopifycloud/checkout-web/assets/c1/PaymentButtons.DcjElSm_.js","/cdn/shopifycloud/checkout-web/assets/c1/LocalPickup.DNaisRKM.js","/cdn/shopifycloud/checkout-web/assets/c1/useShopPayButtonClassName.Yfrmb-Fp.js","/cdn/shopifycloud/checkout-web/assets/c1/VaultedPayment.bNPic0_d.js"];
      var styles = ["/cdn/shopifycloud/checkout-web/assets/c1/assets/app.CjGn_Lz5.css","/cdn/shopifycloud/checkout-web/assets/c1/assets/LocalPickup.Cuz4ryjJ.css","/cdn/shopifycloud/checkout-web/assets/c1/assets/useShopPayButtonClassName.CBpWLJzT.css","/cdn/shopifycloud/checkout-web/assets/c1/assets/VaultedPayment.OxMVm7u-.css"];
      var fontPreconnectUrls = [];
      var fontPrefetchUrls = [];
      var imgPrefetchUrls = ["https://cdn.shopify.com/s/files/1/0636/5783/6700/files/grocerywala.pl_Logo-1-modified_1_x320.png?v=1726581725"];

      function preconnect(url, callback) {
        var link = document.createElement('link');
        link.rel = 'dns-prefetch preconnect';
        link.href = url;
        link.crossOrigin = '';
        link.onload = link.onerror = callback;
        document.head.appendChild(link);
      }

      function preconnectAssets() {
        var resources = [cdnOrigin].concat(fontPreconnectUrls);
        var index = 0;
        (function next() {
          var res = resources[index++];
          if (res) preconnect(res, next);
        })();
      }

      function prefetch(url, as, callback) {
        var link = document.createElement('link');
        if (link.relList.supports('prefetch')) {
          link.rel = 'prefetch';
          link.fetchPriority = 'low';
          link.as = as;
          if (as === 'font') link.type = 'font/woff2';
          link.href = url;
          link.crossOrigin = '';
          link.onload = link.onerror = callback;
          document.head.appendChild(link);
        } else {
          var xhr = new XMLHttpRequest();
          xhr.open('GET', url, true);
          xhr.onloadend = callback;
          xhr.send();
        }
      }

      function prefetchAssets() {
        var resources = [].concat(
          scripts.map(function(url) { return [url, 'script']; }),
          styles.map(function(url) { return [url, 'style']; }),
          fontPrefetchUrls.map(function(url) { return [url, 'font']; }),
          imgPrefetchUrls.map(function(url) { return [url, 'image']; })
        );
        var index = 0;
        function run() {
          var res = resources[index++];
          if (res) prefetch(res[0], res[1], next);
        }
        var next = (self.requestIdleCallback || setTimeout).bind(self, run);
        next();
      }

      function onLoaded() {
        try {
          if (parseFloat(navigator.connection.effectiveType) > 2 && !navigator.connection.saveData) {
            preconnectAssets();
            prefetchAssets();
          }
        } catch (e) {}
      }

      if (document.readyState === 'complete') {
        onLoaded();
      } else {
        addEventListener('load', onLoaded);
      }
    })();
  