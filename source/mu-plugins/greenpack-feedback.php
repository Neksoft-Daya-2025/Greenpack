<?php
/** Plugin Name: Green Pack Website Feedback September 2026 */
if(!defined('ABSPATH'))exit;
add_action('wp_head',function(){ ?>
<style id="greenpack-feedback-20260909">
.gp-company-inside-footer .gp-company-inside-footer__inner{grid-template-columns:180px repeat(4,minmax(0,1fr));gap:24px}
.gp-company-inside-footer .gp-company-inside-footer__inner img,.gp-company-inside-footer .gp-company-inside-footer__inner img.gp-corp{width:100%;max-width:190px;height:34px;object-fit:contain;object-position:left center}
.gp-feedback-network{max-width:1240px;margin:0 auto;padding:48px 24px;color:#0e1714}
.gp-feedback-network-intro{display:grid;grid-template-columns:1.1fr 1fr;align-items:center;gap:48px}
.gp-feedback-network-intro>img{width:100%;height:360px;object-fit:cover;border-radius:16px}
.gp-feedback-network h2{font-size:clamp(28px,3vw,42px);line-height:1.15;margin:0 0 22px}
.gp-feedback-network p{font-size:16px;line-height:1.8;color:#52605a;margin:0 0 20px}
.gp-feedback-network .gp-feedback-eyebrow{font-size:13px;letter-spacing:1.5px;font-weight:700;color:#3d6718}
.gp-feedback-button{display:inline-block;background:#a9de59;color:#0e1714!important;border-radius:6px;padding:14px 22px;font-weight:600}
.gp-feedback-network-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin:38px 0 48px;padding:28px;background:#f2f6ed;border-radius:12px}
.gp-feedback-network-stats strong,.gp-feedback-network-stats span{display:block}
.gp-feedback-network-stats strong{font-family:Rajdhani,sans-serif;font-size:36px;line-height:1.2;color:#173e27}
.gp-feedback-network-stats span{font-size:14px;margin-top:8px}
.gp-feedback-network-map{width:100%;max-width:1180px;margin:0 auto;padding:0 24px}
.gp-feedback-locations{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:22px}
.gp-feedback-location{padding:26px;border:1px solid #dfe7da;border-radius:12px;background:#fff;display:flex;flex-direction:column;align-items:flex-start}
.gp-feedback-location h3{font-size:26px;margin:0 0 12px}
.gp-feedback-location p{font-size:15px;flex:1}
.gp-feedback-location a,.gp-feedback-network-bottom a{color:#376218;font-weight:600}
.gp-feedback-network-bottom{padding:38px;background:#f2f6ed;border-radius:12px;margin-top:32px}
@media(max-width:1024px){.gp-company-inside-footer .gp-company-inside-footer__inner{grid-template-columns:repeat(4,minmax(0,1fr));gap:20px}.gp-company-inside-footer__title{grid-column:1/-1}.gp-feedback-network-intro{gap:28px}.gp-feedback-locations{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:767px){.gp-feedback-network-intro{grid-template-columns:1fr}.gp-feedback-network-intro>img{height:250px}.gp-feedback-network{padding:32px 20px}.gp-feedback-network-stats{gap:14px;padding:20px}.gp-feedback-network-stats strong{font-size:28px}.gp-feedback-network-stats span{font-size:12px}.gp-feedback-network-bottom{padding:24px}}
@media(max-width:560px){.gp-company-inside-footer .gp-company-inside-footer__inner{grid-template-columns:repeat(2,minmax(0,1fr));gap:20px}.gp-company-inside-footer .gp-company-inside-footer__inner img,.gp-company-inside-footer .gp-company-inside-footer__inner img.gp-corp{max-width:170px;height:30px}.gp-feedback-locations{grid-template-columns:1fr}}
/* Keep the English home hero action row stable if a builder cache injects a copied button. */
.elementor-680 .elementor-element-1eaa58e{display:flex!important;flex-wrap:nowrap!important;isolation:isolate}
.elementor-680 .elementor-element-1eaa58e>.elementor-element-7269c15,.elementor-680 .elementor-element-1eaa58e>.elementor-element-4b82079{display:block!important;position:relative!important;visibility:visible!important;opacity:1!important;transform:none!important}
.elementor-680 .elementor-element-1eaa58e>.elementor-widget-elementskit-creative-button:not(.elementor-element-7269c15):not(.elementor-element-4b82079){display:none!important}



/* Keep the Green Pack badge and company description visible on one row. */
.page-id-2113 .elementor-element-17257ad{display:flex!important;flex-direction:column!important;flex-wrap:nowrap!important;align-items:center!important;justify-content:center!important;align-content:center!important;gap:12px!important;width:100%!important;max-width:100%!important;margin:0 auto!important;text-align:center!important;visibility:visible!important;opacity:1!important;transform:none!important;animation:none!important}
.page-id-2113 .elementor-element-17257ad>.elementor-element-cae0bc8{flex:0 0 auto!important;margin:0!important}
.page-id-2113 .elementor-element-17257ad>.elementor-element-cae0bc8 h3{margin:0!important;white-space:nowrap}
.page-id-2113 .elementor-element-17257ad>.elementor-element-d82b2e0{flex:1 1 auto!important;min-width:0!important;margin:0!important;visibility:visible!important;opacity:1!important}
.page-id-2113 .elementor-element-17257ad>.elementor-element-d82b2e0,.page-id-2113 .elementor-element-17257ad>.elementor-element-d82b2e0 p{margin:0!important}
.page-id-2113 .elementor-element-17257ad>.elementor-element-cae0bc8,.page-id-2113 .elementor-element-17257ad>.elementor-element-d82b2e0{width:auto!important;max-width:none!important}
.page-id-2113 .elementor-element-17257ad>.elementor-element-d82b2e0{flex:0 1 auto!important}
.page-id-2113 .elementor-element-17257ad>.elementor-element-d82b2e0{width:min(1100px,calc(100% - 32px))!important;text-align:center!important}
.page-id-2113 .elementor-element-17257ad>.elementor-element-d82b2e0 .elementor-widget-container{margin:0 auto!important}


@media(max-width:767px){.page-id-2113 .elementor-element-17257ad{flex-wrap:wrap!important;align-items:flex-start!important}.page-id-2113 .elementor-element-17257ad>.elementor-element-d82b2e0{flex-basis:100%!important}}

/* Restore the photographic background on the About Us page header. */
.page-id-2113 .elementor-2113>.elementor-element-3a64d93{background-image:linear-gradient(rgba(7,25,20,.72),rgba(7,25,20,.72)),url("https://greenpack.neksoftconsultancy.in/wp-content/uploads/2025/11/page-header-bg.png")!important;background-position:center!important;background-size:cover!important;background-repeat:no-repeat!important;border-radius:20px!important;overflow:hidden!important}

/* Restored image treatment for the About page header. */
.page-id-2113 .elementor-element-3a64d93{background-image:linear-gradient(rgba(7,25,20,.76),rgba(7,25,20,.76)),url("https://greenpack.neksoftconsultancy.in/wp-content/uploads/2025/11/page-header-bg.png")!important;background-position:center!important;background-size:cover!important;background-repeat:no-repeat!important}

/* About Us hero: readable dark-green image overlay. */
.page-id-2113 .elementor-element-5575735::before {
  content: "" !important;
  position: absolute !important;
  inset: 0 !important;
  z-index: 1 !important;
  background: linear-gradient(90deg, rgba(5,24,18,.58), rgba(8,34,25,.46)) !important;
  pointer-events: none !important;
}
.page-id-2113 .elementor-element-5575735 > .elementor-container,
.page-id-2113 .elementor-element-5575735 > .e-con-inner {
  position: relative !important;
  z-index: 2 !important;
}

/* Normalize partner-brand marks in the footer at the same optical scale. */
.gp-company-inside-footer .gp-company-inside-footer__inner > *{display:flex!important;align-items:center!important;min-height:42px!important}
.gp-company-inside-footer .gp-company-inside-footer__inner img{display:block!important;width:auto!important;max-width:100%!important;height:36px!important;object-fit:contain!important;object-position:left center!important}
.gp-company-inside-footer .gp-company-inside-footer__inner img[src$="logo-green-corporation.svg"],.gp-company-inside-footer .gp-company-inside-footer__inner img[src$="logo-green.svg"]{transform:scale(1.14)!important;transform-origin:left center!important}
.gp-company-inside-footer .gp-company-inside-footer__inner img[src$="logo-green-point.svg"],.gp-company-inside-footer .gp-company-inside-footer__inner img[src$="logo-green-unit.svg"]{transform:scale(.96)!important;transform-origin:left center!important}

/* Keep every footer company logo at exactly the same visual height. */
.gp-company-inside-footer .gp-company-inside-footer__inner img[src]{height:36px!important;transform:none!important;transform-origin:left center!important}

/* Optically normalize individual SVG artwork: identical apparent logo height. */
.gp-company-inside-footer .gp-company-inside-footer__inner img[src$="logo-green-corporation.svg"]{transform:scale(1.05)!important}
.gp-company-inside-footer .gp-company-inside-footer__inner img[src$="logo-green-point.svg"],.gp-company-inside-footer .gp-company-inside-footer__inner img[src$="logo-green-unit.svg"]{transform:scale(.85)!important}
.gp-company-inside-footer .gp-company-inside-footer__inner img[src$="logo-green_v3.svg"]{transform:scale(.98)!important}
.gp-company-inside-footer .gp-company-inside-footer__inner img[src]{transform-origin:center center!important}

/* Final optical compensation for Green Pack artwork, which has extra SVG canvas padding. */
.gp-company-inside-footer .gp-company-inside-footer__inner img[src$="logo-green_v3.svg"]{transform:scale(1.12)!important}

/* Company-brand footer row: centred marks with equal controlled gaps. */
.gp-company-inside-footer .gp-company-inside-footer__inner{display:flex!important;align-items:center!important;justify-content:center!important;gap:clamp(48px,6vw,96px)!important;width:100%!important;grid-template-columns:none!important}
.gp-company-inside-footer .gp-company-inside-footer__title{display:none!important}
.gp-company-inside-footer .gp-company-inside-footer__inner>span,.gp-company-inside-footer .gp-company-inside-footer__inner>a{flex:0 0 auto!important;display:flex!important;align-items:center!important;justify-content:center!important;margin:0!important}
@media(max-width:900px){.gp-company-inside-footer .gp-company-inside-footer__inner{gap:32px!important;flex-wrap:wrap!important}.gp-company-inside-footer .gp-company-inside-footer__inner>span,.gp-company-inside-footer .gp-company-inside-footer__inner>a{width:calc(50% - 16px)!important;justify-content:center!important}}
@media(max-width:560px){.gp-company-inside-footer .gp-company-inside-footer__inner{gap:22px!important}.gp-company-inside-footer .gp-company-inside-footer__inner>span,.gp-company-inside-footer .gp-company-inside-footer__inner>a{width:100%!important}}

/* Final brand-row baseline: use one exact logo height; spacing is handled by the flex row. */
.gp-company-inside-footer .gp-company-inside-footer__inner img[src]{height:36px!important;transform:none!important;transform-origin:center center!important}

/* Keep all four company brands in one balanced desktop row. */
@media(min-width:901px){.gp-company-inside-footer .gp-company-inside-footer__inner{flex-wrap:nowrap!important;gap:clamp(28px,3.2vw,52px)!important}}

/* Green Pack source SVG contains extra artwork padding; match its visible mark to the group. */
.gp-company-inside-footer .gp-company-inside-footer__inner img[src$="logo-green_v3.svg"]{transform:scale(1.30)!important;transform-origin:center center!important}

/* Increase Green Pack artwork slightly to match the group visually. */
/* Green Pack remains visually prominent without scaling outside its layout box. */
.gp-company-inside-footer .gp-company-inside-footer__inner img[src$="logo-green_v3.svg"]{height:51px!important;transform:none!important}

/* Service FAQs: except the collection page, show only the first answer initially. */
html.gp-service-faq-single-open .faq-accordion .elementskit-card:not(:first-child)>.collapse,body.gp-service-faq-single-open .faq-accordion .elementskit-card:not(:first-child)>.collapse{display:none!important;height:0!important}
html.gp-service-faq-single-open .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_active_icon,body.gp-service-faq-single-open .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_active_icon{display:none!important}
html.gp-service-faq-single-open .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_normal_icon,body.gp-service-faq-single-open .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_normal_icon{display:block!important}

/* gp-faq-default-style */
html.gp-service-faq-single-open .faq-accordion .elementskit-card:not(:first-child)>.collapse,body.gp-service-faq-single-open .faq-accordion .elementskit-card:not(:first-child)>.collapse{display:none!important;height:0!important}
html.gp-service-faq-single-open .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_active_icon,body.gp-service-faq-single-open .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_active_icon{display:none!important}
html.gp-service-faq-single-open .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_normal_icon,body.gp-service-faq-single-open .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_normal_icon{display:block!important}

/* gp-faq-page-default-style */
body.page-id-12833 .faq-accordion .elementskit-card:not(:first-child)>.collapse,body.page-id-12834 .faq-accordion .elementskit-card:not(:first-child)>.collapse,body.page-id-12835 .faq-accordion .elementskit-card:not(:first-child)>.collapse,body.page-id-12836 .faq-accordion .elementskit-card:not(:first-child)>.collapse,body.page-id-12837 .faq-accordion .elementskit-card:not(:first-child)>.collapse,body.page-id-12838 .faq-accordion .elementskit-card:not(:first-child)>.collapse{display:none!important;height:0!important}
body.page-id-12833 .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_active_icon,body.page-id-12834 .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_active_icon,body.page-id-12835 .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_active_icon,body.page-id-12836 .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_active_icon,body.page-id-12837 .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_active_icon,body.page-id-12838 .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_active_icon{display:none!important}
body.page-id-12833 .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_normal_icon,body.page-id-12834 .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_normal_icon,body.page-id-12835 .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_normal_icon,body.page-id-12836 .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_normal_icon,body.page-id-12837 .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_normal_icon,body.page-id-12838 .faq-accordion .elementskit-card:not(:first-child) .ekit_accordion_normal_icon{display:block!important}
/* gp-national-locations-compact */
.page-id-12843 .gp-locations{align-items:start!important;gap:25px!important}
.page-id-12843 .gp-location-card{height:auto!important;min-height:0!important;align-self:start!important}
.page-id-12843 .gp-location-content{min-height:0!important}
@media(max-width:900px){.page-id-12843 .gp-locations{gap:18px!important}}
/* gp-national-locations-tablet */
@media (min-width:601px) and (max-width:900px){.page-id-12843 .gp-locations{grid-template-columns:repeat(3,minmax(0,1fr))!important}.page-id-12843 .gp-location-card{padding:24px 18px!important;gap:14px!important}.page-id-12843 .gp-location-content h3{font-size:18px!important}.page-id-12843 .gp-location-content li{font-size:15px!important;padding-left:18px!important}}
</style>
<script id="greenpack-route-header-images">
(function(){
  var path=window.location.pathname.replace(/\/+$/, '/') || '/';
  var images={
    '/en/instalatii-echipamente/':'https://greenpack.neksoftconsultancy.in/wp-content/uploads/greenpack-old/infrastructura/img-02.webp',
    '/en/flota-auto/':'https://greenpack.neksoftconsultancy.in/wp-content/uploads/greenpack-old/flota/img-01.webp',
    '/instalatii-echipamente/':'https://greenpack.neksoftconsultancy.in/wp-content/uploads/greenpack-old/infrastructura/img-02.webp',
    '/flota-auto/':'https://greenpack.neksoftconsultancy.in/wp-content/uploads/greenpack-old/flota/img-01.webp'
  };
  var image=images[path]; if(!image)return;
  function apply(){document.querySelectorAll('.page-header').forEach(function(el){el.style.setProperty('background-image','linear-gradient(rgba(6,25,18,.56),rgba(6,25,18,.56)),url("'+image+'")','important');el.style.setProperty('background-position','center','important');el.style.setProperty('background-size','cover','important');});}
  if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',apply);else apply();
})();
</script>
<script id="greenpack-romanian-footer-copy">
(function(){
  if(window.location.pathname.indexOf('/en/')===0) return;
  function apply(){
    var labels={'Get In Touch':'Contactează-ne','WASTE MANAGEMENT':'GESTIONAREA DEȘEURILOR','Waste Management':'Managementul deșeurilor','Home':'Acasă','About Us':'Despre noi','Services':'Servicii'};
    document.querySelectorAll('a,button').forEach(function(a){
      var current=a.textContent.trim(); if(labels[current]) a.textContent=labels[current];
    });
  }
  if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',apply); else apply(); [100,500,1200,2500,5000].forEach(function(delay){setTimeout(apply,delay);}); new MutationObserver(apply).observe(document.documentElement,{childList:true,subtree:true});
})();
</script>
<script id="greenpack-service-faq-default">
(function(){
  var excluded=['/servicii-colectare/','/en/servicii-colectare/','/services/waste-collection/','/en/services/waste-collection/'];
  var path=window.location.pathname.replace(/\/+$/,'/')||'/';
  if(excluded.indexOf(path)!==-1)return; document.documentElement.classList.add('gp-service-faq-single-open'); document.addEventListener('DOMContentLoaded',function(){document.body.classList.add('gp-service-faq-single-open');});
  function setDefaultState(){
    document.querySelectorAll('.faq-accordion .elementskit-accordion').forEach(function(accordion){
      var panels=accordion.querySelectorAll('.collapse');
      var toggles=accordion.querySelectorAll('.ekit-accordion--toggler');
      panels.forEach(function(panel,index){
        var open=index===0;
        panel.classList.toggle('show',open);
        panel.style.height=open?'':'0px';
        if(!open) panel.style.display='';
      });
      toggles.forEach(function(toggle,index){
        var open=index===0;
        toggle.setAttribute('aria-expanded',open?'true':'false');
        toggle.classList.toggle('collapsed',!open);
      });
    });
  }
  if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',setDefaultState);else setDefaultState();
  [100,500,1200].forEach(function(delay){setTimeout(setDefaultState,delay);});
})();
</script>
<?php },100);

add_action('wp_footer', function(){
  if (strpos($_SERVER['REQUEST_URI'] ?? '', '/en/about-us/') !== 0) return;
  ?>
<script id="greenpack-about-english-dynamic-copy">
(function(){
  function replaceText(node, from, to){ if(node && node.textContent.indexOf(from)!==-1) node.textContent=to; }
  function apply(){
    document.querySelectorAll('a,button,.elementor-button-text').forEach(function(el){
      if(el.textContent.trim()==='Solicită o ofertă') el.childNodes.forEach(function(n){ if(n.nodeType===3) n.nodeValue='Request a quote'; });
      if(el.textContent.trim()==='Solicită o ofertă') el.textContent='Request a quote';
    });
    document.querySelectorAll('.e-text-path,[data-text]').forEach(function(el){
      var text=el.getAttribute('data-text') || el.textContent || '';
      if(text.indexOf('Luați legătura cu noi')===-1) return;
      var translated='Get in touch with us * Get in touch with us *';
      el.setAttribute('data-text',translated);
      el.querySelectorAll('textPath').forEach(function(p){p.textContent=translated;});
      el.querySelectorAll('[data-settings]').forEach(function(x){x.setAttribute('data-settings',x.getAttribute('data-settings').replace(/Lua\\u021bi leg\\u0103tura cu noi/g,'Get in touch with us'));});
    });
  }
  apply();[200,800,1800,3500].forEach(function(ms){setTimeout(apply,ms);});
})();
</script>
<?php
}, 999);

add_action('wp_footer', function(){ ?>
<script id="greenpack-video-poster-fallback">
(function(){var poster='https://greenpack.neksoftconsultancy.in/wp-content/uploads/2026/09/gpk-video-poster.jpg';function apply(){document.querySelectorAll('video').forEach(function(v){if((v.currentSrc||v.querySelector('source')?.src||'').indexOf('GPK_v2.5.mp4')!==-1){v.setAttribute('poster',poster);v.setAttribute('preload','metadata');}})}apply();[200,800,2000].forEach(function(ms){setTimeout(apply,ms);});})();
</script>
<?php },999);
