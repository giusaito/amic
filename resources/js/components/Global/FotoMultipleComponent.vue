<template>
    <v-container>
        <v-row justify="center">
            <v-col cols=12>
                <div class="uploader" @dragenter="onDragEnter" @dragleave="onDragLeave" @dragover.prevent @drop="onDrop" :class="{ dragging: isDragging }">
                    <div class="upload-control" v-show="images.length">
                        <label for="file">Selecione o arquivo</label>
                        <button @click="upload">Enviar</button>
                    </div>
                    <div v-show="!images.length">
                        <i class="fa fa-cloud-upload"></i>
                        <p>Arraste suas imagens para cá</p>
                        <div>OU</div>
                        <div class="file-input">
                            <label for="file">Selecione o arquivo</label>
                            <input type="file" id="file" @change="onInputChange" multiple>
                        </div>
                    </div>
                    <div class="images-preview" v-show="images.length">
                        <div class="img-wrapper" v-for="(image, index) in images" :image="image" :key="index">
                            <img :src="image" :alt="`Imagem enviada ${index}`">
                            <div class="details">
                                <div class="name" v-text="files[index].name"></div>
                                <span class="size" v-text="files[index].size"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
export default {
    props: {
        "images": Array,
        "galeria": String
    },
    data: () => ({
        isDragging: false,
        dragCount: 0,
        files: [],
        // images: [],
    }),
    methods: {
        onDragEnter(e) {
            e.preventDefault();
            this.dragCount++;
            this.isDragging = true;
        },
        onDragLeave(e) {
            e.preventDefault();
            this.dragCount--;

            if(this.dragCount <= 0){
                this.isDragging = false;
            }
        },
        onInputChange(e) {
            const files = e.target.files;

            alert(this.galeria);
            alert('onInputChange');
            
            Array.from(files).forEach(file => this.addImage(file));
        },
        onDrop(e) {
            e.preventDefault();
            e.stopPropagation();

            this.isDragging = false;

            const files = e.dataTransfer.files;

             alert(this.galeria);
            alert('onDrop');
            
            Array.from(files).forEach(file => this.addImage(file));
        },
        addImage(file) {
            if(!file.type.match('image.*')) {
                console.log(`${file.name} não é uma imagem`);
                return;
            }
            this.files.push(file);
            const img = new Image(),
                  reader = new FileReader();

            // this.$emit('arrayimagens', e.target.result);
            // reader.onload = (e) => this.images.push(e.target.result);
            reader.onload = (e) => this.$emit('arrayimagens', {'conteudo':e.target.result, 'galeria':this.name});
            console.log(this.images);
            reader.readAsDataURL(file);
        },
        getFileSize(size) {
            const fSExt = ['Bytes', 'KB', 'MB', 'GB'];
            let i = 0;
            
            while(size > 900) {
                size /= 1024;
                i++;
            }
            return `${(Math.round(size * 100) / 100)} ${fSExt[i]}`;
        },
        upload() {
            const formData = new FormData();
            
            this.files.forEach(file => {
                formData.append('images[]', file, file.name);
            });
            axios.post('/images-upload', formData)
                .then(response => {
                    this.$toastr.s('Todas as imagens foram enviadas com sucesso');
                    this.images = [];
                    this.files = [];
                })
        }
    }
}
</script>
<style lang="scss" scoped>
.uploader {
	width:100%;
	background: #2196F3;
	color:#fff;
	padding: 40px 15px;
	border-radius: 10px;
	border:3px dashed #fff;
	font-size:20px;
	position:relative;
    text-align: center;
    &.dragging {
        background:#fff;
        color: #2196F3;
        border:3px dashed #2196F3;
        .file-input label {
            background:#2196F3;
            color: #fff;
        }
    }
    i {
        font-size: 85px;
    }
    .file-input {
        width:220px;
        margin:auto;
        height:68px;
        position:relative;
        label, input {
            background:#fff;
            color:#2196F3;
            width:100%;
            position:absolute;
            left:0;
            top:0;
            padding:10px;
            border-radius:4px;
            margin-top:7px;
            cursor:pointer;
        }
        input {
            opacity: 0;
            z-index: -2;
        }
    }
    .images-preview {
        display:flex;
        flex-wrap: wrap;
        margin-top:20px;
        .img-wrapper {
            width:160px;
            display:flex;
            flex-direction: column;
            margin:10px;
            height:150px;
            justify-content: space-between;
            background:#fff;
            box-shadow: 5px 5px 20px #3e3737;
            img {
                max-height: 105px;
            }
        }
        .details {
            font-size:12px;
            background:#fff;
            color:#000;
            // display:flex;
            // flex-direction: column;
            // align-items:self-start;
            padding:3px 6px;
            .name {
                text-overflow: ellipsis;
                overflow: hidden;
                white-space: nowrap;
                height:18px;
            }
        }
    }
    .upload-control {
        position: absolute;
        width: 100%;
        background: #fff;
        top: 0;
        left: 0;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
        padding: 10px;
        padding-bottom: 4px;
        text-align: right;
        button, label {
            background: #2196F3;
            border: 2px solid #03A9F4;
            border-radius: 3px;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
        }
        label {
            padding: 2px 5px;
            margin-right: 10px;
        }
    }
}
</style>