<?php

/**
 * This is the tinyMCE (rich text editor) configuration file. Please visit
 * http://tinymce.moxiecode.com for more information.
 *
 * its generated through TinyMCE_Customzier so dont edit it, changes will be overwritten!
 */
if ($GLOBALS['TL_CONFIG']['useRTE']): ?>
<script src="<?php echo $this->base; ?>assets/tinymce/tiny_mce_gzip.js"></script>
<script>
tinyMCE_GZ.init({
  plugins : "advimage,autosave,directionality,emotions,inlinepopups,paste,save,searchreplace,spellchecker,style,tabfocus,table,template,typolinks,xhtmlxtras",
  themes : "advanced",
  languages : "<?php echo $this->language; ?>",
  disk_cache : false,
  debug : false
});
</script>
<script>
tinyMCE.init({
  mode : "none",
  height : "300",
  language : "<?php echo $this->language; ?>",
  elements : "<?php echo $this->rteFields; ?>",
  remove_linebreaks : false,
  force_hex_style_colors : true,
  fix_list_elements : true,
  fix_table_elements : true,
  doctype : '<!DOCTYPE html>',
  element_format : 'html',
  document_base_url : "<?php echo $this->base; ?>",
  entities : "160,nbsp,60,lt,62,gt,173,shy",
  cleanup_on_startup : true,
  save_enablewhendirty : true,
  save_on_tinymce_forms : true,
  init_instance_callback : "TinyCallback.getScrollOffset",
  advimage_update_dimensions_onchange : false,
  external_image_list_url : "<?php echo TL_PATH; ?>/assets/tinymce/plugins/typolinks/typoimages.php",
  template_external_list_url : "<?php echo TL_PATH; ?>/assets/tinymce/plugins/typolinks/typotemplates.php",
  plugins : "contextmenu,fullscreen,paste,searchreplace,visualchars,typolinks,autosave,inlinepopups,save,xhtmlxtras",
  spellchecker_languages : "<?php echo $this->getSpellcheckerString(); ?>",
  content_css : "tl_files/tinymce.css",
  event_elements : "a,div,h1,h2,h3,h4,h5,h6,img,p,span",
  extended_valid_elements : "q[cite|class|title],article,section,hgroup,figure,figcaption,q[cite|class|title],article,section,hgroup,figure,figcaption,footer",
  tabfocus_elements : ":prev,:next",
  accessibility_warnings: true,
  object_resizing: true,
  preformatted: true,
  file_browser_callback: "customTinyMceFilebrowser",
  theme : "advanced",
  theme_advanced_font_sizes : "9px=9px,10px=10px,11px=11px,12px=12px,13px=13px,14px=14px,15px=15px,16px=16px,17px=17px,18px=18px,19px=19px,20px=20px,21px=21px,22px=22px,23px=23px,24px=24px",
  theme_advanced_more_colors: false,
  theme_advanced_resizing : true,
  theme_advanced_resize_horizontal : false,
  theme_advanced_toolbar_location : "top",
  theme_advanced_toolbar_align : "left",
  theme_advanced_source_editor_width : "700",
  theme_advanced_blockformats : "div,p,address,pre,h1,h2,h3,h4,h5,h6",
  theme_advanced_buttons1 : "typolinks,unlink,separator,sub,sup,separator,abbr,cite,blockquote,separator,bullist,numlist,separator,attribs,separator,search,replace,separator,undo,redo,separator,removeformat,cleanup,separator,code,separator,charmap",
  theme_advanced_buttons2 : "",
  theme_advanced_buttons3 : "",
  theme_advanced_statusbar_location : "bottom"
});

function customTinyMceFilebrowser(field_name, url, type, win)
{
TinyCallback.fileBrowser(field_name, url, type, win);}

</script>
<?php endif; ?>
