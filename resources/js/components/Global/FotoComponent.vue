<template>
    <div>
        <input ref="input" type="file" name="image" accept="image/*" @change="setImage" />
        <v-col cols=12>
            <div class="content">
                <div class="btn-group buttons-group-crop">
                    <button type="button" class="btn btn-primary" @click.prevent="showFileChooser">
                        <span class="fa fa-upload"></span> {{ textUpload }}
                    </button>
                </div>
                <div class="btn-group buttons-group-crop" v-if="imgSrc">
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <button type="button" class="btn btn-warning" @click.prevent="zoom(0.2)" v-bind="attrs" v-on="on">
                                <span class="fa fa-search-plus"></span>
                            </button>
                        </template>
                        <span>Zoom +</span>
                    </v-tooltip>
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <button type="button" class="btn btn-warning" @click.prevent="zoom(-0.2)" v-bind="attrs" v-on="on">
                                <span class="fa fa-search-minus"></span>
                            </button>
                        </template>
                        <span>Zoom -</span>
                    </v-tooltip>
                </div>
                <div class="btn-group buttons-group-crop" v-if="imgSrc">
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <button type="button" class="btn btn-warning" @click.prevent="move(-10, 0)" v-bind="attrs" v-on="on">
                                <span class="fa fa-arrow-left"></span>
                            </button>
                        </template>
                        <span>Mover para a esquerda</span>
                    </v-tooltip>
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <button type="button" class="btn btn-warning" @click.prevent="move(10, 0)" v-bind="attrs" v-on="on">
                                <span class="fa fa-arrow-right"></span>
                            </button>
                        </template>
                        <span>Mover para direita</span>
                    </v-tooltip>
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <button type="button" class="btn btn-warning" @click.prevent="move(0, -10)" v-bind="attrs" v-on="on">
                                <span class="fa fa-arrow-up"></span>
                            </button>
                        </template>
                        <span>Mover para cima</span>
                    </v-tooltip>
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <button type="button" class="btn btn-warning" @click.prevent="move(0, 10)" v-bind="attrs" v-on="on">
                                <span class="fa fa-arrow-down"></span>
                            </button>
                        </template>
                        <span>Mover para baixo</span>
                    </v-tooltip>
                </div>
                <div class="btn-group buttons-group-crop" v-if="imgSrc">
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <button type="button" class="btn btn-warning" @click.prevent="rotate(-45)" v-bind="attrs" v-on="on">
                                <span class="fa fa-rotate-left"></span>
                            </button>
                        </template>
                        <span>Rotacionar -45º</span>
                    </v-tooltip>
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <button type="button" class="btn btn-warning" @click.prevent="rotate(45)" v-bind="attrs" v-on="on">
                                <span class="fa fa-rotate-right"></span>
                            </button>
                        </template>
                        <span>Rotacionar +45º</span>
                    </v-tooltip>
                </div>
                <div class="btn-group buttons-group-crop" v-if="imgSrc">
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <button ref="flipY" type="button" class="btn btn-warning" @click.prevent="flipY" v-bind="attrs" v-on="on">
                                <span class="fa fa-arrows-v"></span>
                            </button>
                        </template>
                        <span>Girar verticalmente</span>
                    </v-tooltip>
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <button ref="flipX" type="button" class="btn btn-warning" @click.prevent="flipX" v-bind="attrs" v-on="on">
                                <span class="fa fa-arrows-h"></span>
                            </button>
                        </template>
                        <span>Girar horizontalmente</span>
                    </v-tooltip>
                </div>
                <div class="btn-group buttons-group-crop" v-if="imgSrc">
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <button type="button" class="btn btn-warning" @click.prevent="cropImage" v-bind="attrs" v-on="on">
                                <span class="fa fa-check"></span>
                            </button>
                        </template>
                        <span>Cortar</span>
                    </v-tooltip>
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <button type="button" class="btn btn-warning" @click.prevent="reset" v-bind="attrs" v-on="on">
                                <span class="fa fa-times"></span>
                            </button>
                        </template>
                        <span>Redefinir</span>
                    </v-tooltip>
                </div>
                <!-- <button type="button" class="btn btn-primary" @click.prevent="getData">
                    Get Data
                </button>
                <button type="button" class="btn btn-primary" @click.prevent="setData">
                    Set Data
                </button>
                <button type="button" class="btn btn-primary" @click.prevent="getCropBoxData">
                    Get CropBox Data
                </button>
                <button type="button" class="btn btn-primary" @click.prevent="setCropBoxData">
                    Set CropBox Data
                </button> -->
            </div>
        </v-col>
        <div v-if="imgSrc">
            <v-container>
                <v-row>
                    <v-col cols=7>
                        <section class="cropper-area">
                            <div class="img-cropper">
                                {{ id }}
                                <!-- <vue-cropper ref="cropper" :aspect-ratio="16 / 9" :src="imgSrc" preview=".preview" /> -->
                                <vue-cropper ref="cropper" :src="imgSrc" :preview="'.preview-'+id" />
                            </div>
                            <div class="actions">
                                <textarea v-model="data" />
                            </div>
                        </section>
                    </v-col>
                    <v-col cols="5">
                        <section class="preview-area">
                            <v-row>
                                <v-col cols=6>
                                    <div class="title mb-1">Visualização</div>
                                    <div class="preview" :class="'preview-'+id" />
                                </v-col>
                                <v-col cols=6>
                                    <div class="title mb-1">Resultado</div>
                                    <v-img v-if="cropImg" :src="cropImg" contain></v-img>
                                    <div v-else class="crop-placeholder" />
                                </v-col>
                            </v-row>
                            <!-- <p>Visualização</p>
                            <div class="preview" />
                            <p>Logo Finalizada</p>
                            <div class="cropped-image">
                            <img v-if="cropImg" :src="cropImg" alt="Cropped Image" />
                            <div v-else class="crop-placeholder" />
                            </div> -->
                        </section>
                    </v-col>
                </v-row>
            </v-container>
        </div>
    </div>
</template>

<script>
import VueCropper from 'vue-cropperjs';
import 'cropperjs/dist/cropper.css';
export default {
  components: {
    VueCropper,
  },
  props: {
    'textUpload': String,
    'id': String,
  },
  data() {
    return {
      imgSrc: '',
      cropImg: '',
      data: null,
    };
  },
  methods: {
    cropImage() {
      // get image data for post processing, e.g. upload or setting image src
      this.cropImg = this.$refs.cropper.getCroppedCanvas().toDataURL();
    },
    flipX() {
      const dom = this.$refs.flipX;
      let scale = dom.getAttribute('data-scale');
      scale = scale ? -scale : -1;
      this.$refs.cropper.scaleX(scale);
      dom.setAttribute('data-scale', scale);
    },
    flipY() {
      const dom = this.$refs.flipY;
      let scale = dom.getAttribute('data-scale');
      scale = scale ? -scale : -1;
      this.$refs.cropper.scaleY(scale);
      dom.setAttribute('data-scale', scale);
    },
    getCropBoxData() {
      this.data = JSON.stringify(this.$refs.cropper.getCropBoxData(), null, 4);
    },
    getData() {
      this.data = JSON.stringify(this.$refs.cropper.getData(), null, 4);
    },
    move(offsetX, offsetY) {
      this.$refs.cropper.move(offsetX, offsetY);
    },
    reset() {
      this.$refs.cropper.reset();
    },
    rotate(deg) {
      this.$refs.cropper.rotate(deg);
    },
    setCropBoxData() {
      if (!this.data) return;
      this.$refs.cropper.setCropBoxData(JSON.parse(this.data));
    },
    setData() {
      if (!this.data) return;
      this.$refs.cropper.setData(JSON.parse(this.data));
    },
    setImage(e) {
      const file = e.target.files[0];
      if (file.type.indexOf('image/') === -1) {
        alert('Please select an image file');
        return;
      }
      if (typeof FileReader === 'function') {
        const reader = new FileReader();
        reader.onload = (event) => {
          this.imgSrc = event.target.result;
          // rebuild cropperjs with the updated source
          this.$refs.cropper.replace(event.target.result);
        };
        reader.readAsDataURL(file);
      } else {
        alert('Sorry, FileReader API not supported');
      }
    },
    showFileChooser() {
      this.$refs.input.click();
    },
    zoom(percent) {
      this.$refs.cropper.relativeZoom(percent);
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
.buttons-group-crop {
    margin: 0 10px 0 0;
}
input[type="file"] {
  display: none;
}
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 0 5px 0;
}
.header h2 {
  margin: 0;
}
.header a {
  text-decoration: none;
  color: black;
}
.content {
  display: flex;
  /* justify-content: space-between; */
}
.cropper-area {
  width: 414px;
}
.actions {
  margin-top: 1rem;
}
.actions a {
  display: inline-block;
  padding: 5px 15px;
  background: #0062CC;
  color: white;
  text-decoration: none;
  border-radius: 3px;
  margin-right: 1rem;
  margin-bottom: 1rem;
}
textarea {
  width: 100%;
  height: 100px;
}
.preview-area {
  width: 307px;
}
.preview-area p {
  font-size: 1.25rem;
  margin: 0;
  margin-bottom: 1rem;
}
.preview-area p:last-of-type {
  margin-top: 1rem;
}
.preview {
  width: 100%;
  height: calc(372px * (9 / 16));
  overflow: hidden;
}
.crop-placeholder {
  width: 100%;
  height: 200px;
  background: #ccc;
}
.cropped-image img {
  max-width: 100%;
}
</style>