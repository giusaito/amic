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
                                <!-- <form v-on:submit.prevent="createProject"> -->
                                    <p v-if="errors.length">
                                        <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
                                        <ul>
                                        <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
                                        </ul>
                                    </p>
                                <form @submit="checkForm" :action="edicoesSaveRoute" method="post">
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
                                                                <td><strong>Empresa</strong></td>
                                                                <td><strong>Site (URL)</strong></td>
                                                                <td><strong>Logo</strong></td>
                                                                <td></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(row, index) in rowsEmpresas" v-bind:key="index">

                                                                <td><input type="text" v-model="row.empresa" name="empresa[]" class="form-control"></td>
                                                                <td><input type="text" v-model="row.url" name="url[]" class="form-control"></td>
                                                                <td>
                                                                    <label class="fileContainer">
                                                                        <!-- {{row.file.name}} -->
                                                                        <input type="file" @change="setFilename($event, row)" :id="index" name="logo[]" class="form-control">
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <button v-show="index > 0" v-on:click="removeElement(index);" style="cursor: pointer" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <button class="btn btn-primary btn-rounded" @click="addRowEmpresa"><i class="fa fa-plus"></i> Adicionar Empresa</button>
                                                </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>Salvar edição</strong></button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="_token" :value="csrf">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
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
                </div> -->
            </div>
        </div>
    </v-app>
</template>
<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import * as projectEditionService from '../../services/project_edition_service';
    import moment from 'moment';
    //import vue2Dropzone from 'vue2-dropzone'
    //import 'vue2-dropzone/dist/vue2Dropzone.min.css'
    export default {
        props: ['homeRoute', 'projetosRoute', 'projeto', 'edicoesSaveRoute'],
        // components: {
        //     vueDropzone: vue2Dropzone
        // },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
                // slideshowDropzoneOptions: {
                //     url: 'https://httpbin.org/post',
                //     thumbnailWidth: 150,
                //     maxFilesize: 0.5,
                //     addRemoveLinks: true,
                //     dictDefaultMessage: "<i class='fa fa-cloud-upload'></i>ARRASTE AS IMAGENS PARA CÁ OU CLIQUE AQUI",
                //     dictRemoveFile: "Remover",
                //     headers: { "My-Awesome-Header": "header value" }
                // },
                // fotosDropzoneOptions: {
                //     url: 'https://httpbin.org/post',
                //     thumbnailWidth: 150,
                //     maxFilesize: 0.5,
                //     addRemoveLinks: true,
                //     dictDefaultMessage: "<i class='fa fa-cloud-upload'></i>ARRASTE AS IMAGENS PARA CÁ OU CLIQUE AQUI",
                //     dictRemoveFile: "Remover",
                //     headers: { "My-Awesome-Header": "header value" }
                // },
                rowsEmpresas: [],
                errors: [],
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
                    empresa: "",
                    url: "",
                    file: {
                        name: 'Escolha a logo'
                    }
                });
            },
            removeElement: function(index) {
                this.rowsEmpresas.splice(index, 1);
            },
            setFilename: function(event, row) {
                var file = event.target.files[0];
                row.file = file
            },
            checkForm: function (e) {
                if (this.editionData.description && this.editionData.date_event && this.editionData.date_event_finish) {
                    return true;
                }

                this.errors = [];

                if (!this.editionData.description) {
                    this.errors.push('A descrição é obrigatória.');
                }
                if (!this.editionData.date_event) {
                    this.errors.push('A data do evento é obrigatória.');
                }
                if (!this.editionData.date_event_finish) {
                    this.errors.push('A data do término do evento é obrigatória.');
                }

                e.preventDefault();
            }
        },
        mounted(){
            this.addRowEmpresa();
        }
    }
</script>
<style scoped>
input[type="file"]{
    display:block;
}
</style>