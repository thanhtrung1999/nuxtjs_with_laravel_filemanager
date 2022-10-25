<template>
  <!-- <Tutorial/> -->
  <div id="app">
    <editor :api-key="apiKeyTinyMCE" :init="initTinyMCE" />
  </div>
</template>

<script>
import Editor from "@tinymce/tinymce-vue";
export default {
  name: "index",
  components: {
    editor: Editor,
  },
  data() {
    return {
      rootApiUrl: process.env.rootApiUrl,
      apiKeyTinyMCE: process.env.apiKeyTinyMCE,
      initTinyMCE: {
        height: 500,
        plugins: [
          "advlist autolink lists link image imagetools charmap print preview anchor",
          "searchreplace visualblocks code fullscreen",
          "insertdatetime media table paste code help wordcount",
        ],
        toolbar:
          "undo redo | formatselect | styleselect | bold italic underline backcolor | \
           fontselect fontsizeselect | image code | \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | removeformat | help",
        file_picker_types: "image",
        file_picker_callback: (cb, value, meta) => {
          this.handlePickerImage(cb, value, meta);
        },
        images_reuse_filename: true,
        // images_upload_handler: (blobInfo, success, failure) => {
        //   setTimeout(function () {
        //     success("http://moxiecode.cachefly.net/tinymce/v9/images/logo.png");
        //   }, 2000);
        // },
      },
    };
  },
  methods: {
    handlePickerImage(cb, value, meta) {
      var cmsURL = this.rootApiUrl + "laravel-filemanager?field_name=" + meta.fieldname;
      console.log("cmsURL", cmsURL);
      if (meta.filetype == "image") {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }
      window.tinymce.activeEditor.windowManager.openUrl({
        url: cmsURL,
        title: "File Manager",
        resizable: "yes",
        close_previous: "no",
        onMessage: (api, message) => {
          console.log(message);
          api.close();
          cb(message.content);
        },
      });
    },
  },
};
</script>

<style>
#app {
  width: 80%;
  margin: auto;
  margin-top: 20px;
}
</style>
