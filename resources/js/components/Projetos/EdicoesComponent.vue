<template>
    <v-app>
        <div id="container">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>{{ projeto.name }} </h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a :href="homeRoute">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a :href="projetosRoute">Projetos</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Edição {{ projeto.name }}</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Edições <small>Adicionar</small></h5>
                            </div>
                            <div class="ibox-content">
                                <form v-on:submit.prevent="createProject">
                                    <div class="row">
                                        <div class="col-sm-6 b-r">
                                            <b-row>
                                                <b-col cols="3" v-if="isLogo">
                                                    <img class="img-thumbnail img-fluid" src="" ref="newProjectEditionLogoDisplay" style="max-width: 150px;">
                                                </b-col>
                                                <b-col>
                                                    <v-label>Logomarca</v-label>
                                                    <input type="file" v-on:change="attachLogo" ref="newProjectEditionLogo" class="form-control" id="logo" />
                                                    <b-form-invalid-feedback :force-show="true" v-if="errors.logo">{{errors.logo[0]}}</b-form-invalid-feedback>
                                                </b-col>
                                            </b-row>
                                            <b-row>
                                                <b-col cols="3" v-if="isStarringPhoto">
                                                    <img class="img-thumbnail img-fluid" src="" ref="newProjectEditionStarringPhotoDisplay" style="max-width: 150px;">
                                                </b-col>
                                                <b-col>
                                                    <v-label>Foto Principal</v-label>
                                                    <input type="file" v-on:change="attachStarringPhoto" ref="newProjectEditionStarringPhoto" class="form-control" id="logo" />
                                                    <b-form-invalid-feedback :force-show="true" v-if="errors.logo">{{errors.logo[0]}}</b-form-invalid-feedback>
                                                </b-col>
                                            </b-row>
                                            <b-row>
                                                <v-col cols=12>
                                                    <v-datetime-picker label="Data da Edição" v-model="editionData.date_event" dateFormat="dd/MM/yyyy" clearText="Limpar data" locale="pt"></v-datetime-picker>
                                                </v-col>
                                                <v-col cols=12>
                                                    <v-datetime-picker label="Data final da Edição" v-model="editionData.date_event_finish" dateFormat="dd/MM/yyyy" clearText="Limpar data"></v-datetime-picker>
                                                </v-col>
                                            </b-row>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <v-label>Descrição da Edição</v-label>
                                                <ckeditor :editor="editor" v-model="editionData.description" :config="editorConfig"></ckeditor>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>Salvar edição</strong></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Slideshow</h5>
                            </div>
                            <div class="ibox-content">
                                <vue-dropzone ref="slideshowDropzone" id="slideshowDropzone" class="dropzone" :options="slideshowDropzoneOptions" v-on:vdropzone-sending="sendingEvent"></vue-dropzone>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Galeria de fotos</h5>
                            </div>
                            <div class="ibox-content">
                                <vue-dropzone ref="fotosDropzone" id="fotosDropzone" class="dropzone" :options="fotosDropzoneOptions" v-on:vdropzone-sending="sendingEvent"></vue-dropzone>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Empresas participantes</h5>
                            </div>
                            <div class="ibox-content">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td><strong>Title</strong></td>
                                            <td><strong>Description</strong></td>
                                            <td><strong>File</strong></td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(row, index) in rowsEmpresas" v-bind:key="index">

                                            <td><input type="text" v-model="row.title"></td>
                                            <td><input type="text" v-model="row.description"></td>
                                            <td>
                                                <label class="fileContainer">
                                                    {{row.file.name}}
                                                    <input type="file" @change="setFilename($event, row)" :id="index">
                                                </label>
                                            </td>
                                            <td>
                                                <a v-on:click="removeElement(index);" style="cursor: pointer" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button class="button btn-primary" @click="addRowEmpresa">Add row</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </v-app>
</template>
<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import * as projectEditionService from '../../services/project_edition_service';
    import moment from 'moment';
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'
    export default {
        props: ['homeRoute', 'projetosRoute', 'projeto'],
        components: {
            vueDropzone: vue2Dropzone
        },
        data() {
            return {
                isLogo: false,
                isStarringPhoto: false,
                editor: ClassicEditor,
                editorData: '',
                errors: {},
                editorConfig: {
                    language: 'pt',
                    indent_style: 'tab',
                    tab_width: 4,
                },
                editionData: {
                    logo: "",
                    description: "",
                    starring_photo: "",
                    date_event: "",
                    date_event_finish: "",
                    author_id: ""
                },
                slideshowDropzoneOptions: {
                    url: 'https://httpbin.org/post',
                    thumbnailWidth: 150,
                    maxFilesize: 0.5,
                    addRemoveLinks: true,
                    dictDefaultMessage: "<i class='fa fa-cloud-upload'></i>ARRASTE AS IMAGENS PARA CÁ OU CLIQUE AQUI",
                    dictRemoveFile: "Remover",
                    headers: { "My-Awesome-Header": "header value" }
                },
                fotosDropzoneOptions: {
                    url: 'https://httpbin.org/post',
                    thumbnailWidth: 150,
                    maxFilesize: 0.5,
                    addRemoveLinks: true,
                    dictDefaultMessage: "<i class='fa fa-cloud-upload'></i>ARRASTE AS IMAGENS PARA CÁ OU CLIQUE AQUI",
                    dictRemoveFile: "Remover",
                    headers: { "My-Awesome-Header": "header value" }
                },
                rowsEmpresas: []
            }
        },
        methods: {
            attachLogo() {
                this.editionData.logo = this.$refs.newProjectEditionLogo.files[0];
                if(this.editionData.logo.type === 'image/jpeg' || this.editionData.logo.type === 'image/png' || this.editionData.logo.type === 'image/webp'){
                    this.isLogo = true;
                    let reader = new FileReader();
                    reader.addEventListener('load', function() {
                        this.$refs.newProjectEditionLogoDisplay.src = reader.result;
                    }.bind(this), false);

                    reader.readAsDataURL(this.editionData.logo);
                }else {
                    this.isLogo = false;
                }
            },
            attachStarringPhoto() {
                this.editionData.logo = this.$refs.newProjectEditionStarringPhoto.files[0];
                if(this.editionData.logo.type === 'image/jpeg' || this.editionData.logo.type === 'image/png' || this.editionData.logo.type === 'image/webp'){
                    this.isStarringPhoto = true;
                    let reader = new FileReader();
                    reader.addEventListener('load', function() {
                        this.$refs.newProjectEditionStarringPhotoDisplay.src = reader.result;
                    }.bind(this), false);

                    reader.readAsDataURL(this.editionData.logo);
                }else {
                    this.isStarringPhoto = false;
                }
            },
            sendingEvent (file, xhr, formData) {
                formData.append('projeto', this.projeto.id);
            },
            addRowEmpresa: function() {
                var elem = document.createElement('tr');
                this.rowsEmpresas.push({
                    title: "",
                    description: "",
                    file: {
                        name: 'Choose File'
                    }
                });
            },
            removeElement: function(index) {
                this.rowsEmpresas.splice(index, 1);
            },
            setFilename: function(event, row) {
                var file = event.target.files[0];
                row.file = file
            }
        }
    }
</script>
<style scoped>
input[type="file"]{
    display:block;
}
</style>