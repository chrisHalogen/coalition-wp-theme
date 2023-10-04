jQuery(document).ready(function ($) {
    if (document.getElementById("ct-theme-options")) {
      let addButton = document.getElementById("image-select-button");
      let deleteButton = document.getElementById("image-delete-button");
      let img = document.getElementById("asset-image-tag");
      let hidden = document.getElementById("icon-media-id");
  
      let customUploader = wp.media({
        title: "Select Your Business Logo",
        button: {
          text: "Use this Image",
        },
        multiple: false,
      });
  
      addButton.addEventListener("click", function () {
        if (customUploader) {
          customUploader.open();
        }
      });
  
      customUploader.on("select", function () {
        let attachment = customUploader.state().get("selection").first().toJSON();
  
        img.setAttribute("src", attachment.url);
        img.setAttribute("style", "max-width:200px");
        img.setAttribute("style", "max-height:200px");
  
        hidden.setAttribute("value", attachment.id);
      });
  
      deleteButton.addEventListener("click", function () {
        img.removeAttribute("src");
        hidden.removeAttribute("value");
      });
    }
  });
  