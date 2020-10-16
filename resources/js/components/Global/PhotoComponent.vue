<template>
    <div>
        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"     v-on:vdropzone-sending="sendingEvent"  @vdropzone-file-added="vfileAdded"></vue-dropzone>
    </div>
</template>

<script>

import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
  name: 'app',
  components: {
    vueDropzone: vue2Dropzone
  },
  data: function () {
    return {
        logomarca: "",
        name: "",
              removedFile: true,
          maxFiles: 1,
      dropzoneOptions: {
          url: 'http://localhost:3000/painel/tv-amic',
          thumbnailWidth: 350,
          maxFilesize: 2,
          autoProcessQueue: false,
          maxFiles: 1,
                       addRemoveLinks: true,

                              uploadMultiple: false,
        parallelUploads: 1,

          dictDefaultMessage: "<i class='fa fa-cloud-upload'></i>Clique ou arraste uma imagem (Max 2 mb)"

        //   headers: { "My-Awesome-Header": "header value" }
      },
    
    }
  },
  methods: {
      processQueue(){
          this.$refs.myVueDropzone.processQueue();
          formData.append('novoNome', 'info');
          alert('foi');
      },
      sendingEvent (file, xhr, formData) {
        formData.append('logodata22', this.name);
      },
       vfileAdded(file) {

            const formData = new FormData();
    // alert('aaa');
            var teste =  formData.append('novoNome', file['upload']);

        

    //   window.toastr.info('', 'Event : vdropzone-file-added');
    },
    
  }
}

</script>
