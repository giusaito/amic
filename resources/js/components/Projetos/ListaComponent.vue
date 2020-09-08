<template>
<v-app>
    <div id="container">
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>Projetos</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a :href="homeRoute">Painel</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Projetos</strong>
                    </li>
                </ol>
            </div>  
        </div>
        <div class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Lista de projetos cadastrados</h5>
                            <div class="ibox-tools">
                                <button type="button" class="btn btn-primary btn-xs" v-on:click="showNewProjectModal">Criar novo projeto</button>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row m-b-sm m-t-sm">
                                <div class="col-md-1">
                                    <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" @click="getProjetos(pagination.path+'?page='+pagination.current_page)"><i class="fa fa-refresh"></i> Atualizar</button>
                                </div>
                                <div class="col-md-11">
                                    <div class="input-group">
                                        <span class="input-group-prepend" v-if="buscaTermo">
                                            <button type="submit" class="btn btn-sm btn-warning" v-on:click="clearSearch()"> 
                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                            </button>
                                        </span>
                                        <input type="text" placeholder="Buscar" class="form-control-sm form-control" ref="busca" v-on:keyup.enter="buscaEnviar"> 
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-sm btn-primary" v-on:click="buscaEnviar"> OK</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="project-list">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr v-for="projeto in projetos" :key="projeto.id">
                                            <td class="project-status" @click="changeStatus(projeto.id)" style="cursor:pointer;">
                                                <span v-if="projeto.status === 'TRUE'" class="label label-primary">Ativo</span>
                                                <span v-if="projeto.status === 'FALSE'" class="label label-default">Inativo</span>
                                            </td>
                                            <td class="project-title">
                                                <a href="project_detail.html">{{ projeto.name }}</a>
                                                <br>
                                                <small>Adicionado em {{ projeto.created_at | format_date }}</small>
                                            </td>
                                            <td class="project-people">
                                                <div class="lightBoxGallery">
                                                    <a v-if="projeto.logo" :href="'/storage/images/projects/logo/'+projeto.logo" :title="projeto.name" data-gallery="">
                                                        <img :src="'/storage/images/projects/logo/'+projeto.logo" @error="logoUrlAlt">
                                                    </a>
                                                    <img v-else :src="'/storage/images/projects/logo/'+projeto.logo" @error="logoUrlAlt">
                                                    <div id="blueimp-gallery" class="blueimp-gallery">
                                                        <div class="slides"></div>
                                                        <h3 class="title"></h3>
                                                        <a class="prev">‹</a>
                                                        <a class="next">›</a>
                                                        <a class="close">×</a>
                                                        <a class="play-pause"></a>
                                                        <ol class="indicator"></ol>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="project-people tooltip-screen" ref="tooltip">
                                                <small><strong><a href="" v-b-tooltip.hover :title="projeto.user.name"><img alt="image" class="rounded-circle" :src="'/storage/images/avatars/'+projeto.user.id+'/avatar.png'" @error="userUrlAlt"></a></strong></small>
                                            </td>
                                            <td class="project-actions">
                                                <!-- <a href="#" class="btn btn-white btn-sm" @click="edicoesSheet = !edicoesSheet"><i class="fa fa-folder-open"></i> Edições</a> -->
                                                <a href="#" class="btn btn-white btn-sm" @click="openEditions(projeto)"><i class="fa fa-folder-open"></i> Edições</a>
                                                <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> Visualizar </a>
                                                <a href="#" class="btn btn-white btn-sm" v-on:click="editProject(projeto)"><i class="fa fa-pencil"></i> Editar </a>
                                                <button class="btn btn-danger" v-on:click="deleteProject(projeto)">Excluir</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="text-center">
                                <div class="btn-group">
                                    <button type="button" @click="getProjetos(pagination.prev_page_url)" v-bind:class="[{disabled: !pagination.prev_page_url}]" class="btn btn-white"><i class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btn-white" v-for="pageNumber in numberOfPages()" v-bind:key="pageNumber" :class="{'active':(pagination.current_page === pageNumber)}" @click="getProjetos(pagination.path+'?page='+pageNumber)"> {{pageNumber}} </button>
                                    <button type="button" @click="getProjetos(pagination.next_page_url)" v-bind:class="[{disabled: !pagination.next_page_url}]" class="btn btn-white"><i class="fa fa-chevron-right"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <b-modal ref="newProjectModal" hide-footer title="Adicionar Projeto">
            <div class="d-block">
                <form v-on:submit.prevent="createProject">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <b-input v-model="projectData.name" id="name" placeholder="Insira o nome do Projeto" />
                        <b-form-invalid-feedback :force-show="true" v-if="errors.name">{{errors.name[0]}}</b-form-invalid-feedback>
                    </div>
                    <div class="form-group">
                        <label for="name">Logomarca</label>
                        <b-row>
                            <!-- <b-col cols="3" v-if="projectData.logo.type === 'image/jpg' || projectData.logo.type === 'image/png'"> -->
                            <b-col cols="3" v-if="isImagem">
                                <!-- <b-img thumbnail fluid ref="newProjectLogoDisplay"></b-img> -->
                                <img class="img-thumbnail img-fluid" src="" ref="newProjectLogoDisplay">
                            </b-col>
                            <b-col>
                                <input type="file" v-on:change="attachLogo" ref="newProjectLogo" class="form-control" id="logo" />
                                <b-form-invalid-feedback :force-show="true" v-if="errors.logo">{{errors.logo[0]}}</b-form-invalid-feedback>
                            </b-col>
                        </b-row>
                    </div>
                    <hr>
                    <div class="text-right">
                        <button type="button" class="btn btn-default" v-on:click="hideNewProjectModal">Cancelar</button>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Salvar</button>
                    </div>
                </form>
            </div>
        </b-modal>
        <b-modal ref="editProjectModal" hide-footer title="Editar Projeto">
            <div class="d-block">
                <form v-on:submit.prevent="updateProject">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <b-input v-model="editProjectData.name" id="name" placeholder="Insira o nome do Projeto" />
                        <b-form-invalid-feedback :force-show="true" v-if="errors.name">{{errors.name[0]}}</b-form-invalid-feedback>
                    </div>
                    <div class="form-group">
                        <label for="name">Logomarca</label>
                        <b-row>
                            <b-col cols="3">
                                <img class="img-thumbnail img-fluid" :src="`/storage/images/projects/logo/${editProjectData.logo}`" @error="logoUrlAlt" ref="editProjectLogoDisplay">
                            </b-col>
                            <b-col>
                                <input type="file" v-on:change="editAttachLogo" ref="editProjectLogo" class="form-control" id="logo" />
                                <b-form-invalid-feedback :force-show="true" v-if="errors.logo">{{errors.logo[0]}}</b-form-invalid-feedback>
                            </b-col>
                        </b-row>
                    </div>
                    <hr>
                    <div class="text-right">
                        <button type="button" class="btn btn-default" v-on:click="hideEditProjectModal">Cancelar</button>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Editar</button>
                    </div>
                </form>
            </div>
        </b-modal>
        <v-bottom-sheet v-model="edicoesSheet">
            <v-expand-transition>
                <v-sheet v-if="edicaoAtual != null" color="grey lighten-4" height="600" tile>
                    <!-- <v-row class="fill-height" align="center" justify="center">
                        <v-col cols="10">
                            <h3 class="title">{{projetoAtual.edicoes[edicaoAtual]}}</h3>
                        </v-col>
                    </v-row> -->
                    <v-card>
                        <form v-on:submit.prevent="saveEdition">
                        <v-form v-on:submit.prevent="saveEdition" ref="form" lazy-validation>
                            <v-tabs background-color="white" color="deep-orange accent-4" right>
                                <v-tab>Detalhes da Edição</v-tab>
                                <v-tab>Slideshow</v-tab>
                                <v-tab>Fotos</v-tab>
                                <v-tab>Empresas participantes</v-tab>

                                <!-- <v-tab-item v-for="n in 4" :key="n">
                                    {{projetoAtual.edicoes[edicaoAtual]}}
                                    <v-container fluid>
                                        <v-row>
                                            <v-col v-for="i in 36" :key="i" cols="12" md="1">
                                                <v-img :src="`https://picsum.photos/500/300?image=${i * n * 5 + 10}`" :lazy-src="`https://picsum.photos/10/6?image=${i * n * 5 + 10}`" aspect-ratio="1"></v-img>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-tab-item> -->
                                <v-tab-item>
                                    <v-container fluid>
                                        Detalhes da Edição 
                                    </v-container>
                                </v-tab-item>
                                <v-tab-item>
                                    <v-container fluid>
                                        <v-row>
                                            Slideshow
                                        </v-row>
                                    </v-container>
                                </v-tab-item>
                                <v-tab-item>
                                    <v-container fluid>
                                        <v-row>
                                            Fotos
                                        </v-row>
                                    </v-container>
                                </v-tab-item>
                                <v-tab-item>
                                    <v-container fluid>
                                        <v-row>
                                            Empresas participantes
                                        </v-row>
                                    </v-container>
                                </v-tab-item>
                            </v-tabs>
                        </v-form>
                    </v-card>
                </v-sheet>
            </v-expand-transition>
            <v-sheet class="text-left" height="250px">
                <v-btn class="mt-1 float-right close-bottom-sheet" text color="link" @click="edicoesSheet = !edicoesSheet" small>
                    <v-icon small>mdi mdi-close</v-icon>fechar
                </v-btn>
                <v-card>
                    <v-card-title>
                        {{projetoAtual.name}} 
                        <v-btn rounded small color="blue-grey" class="ma-2 white--text" @click="edicaoAtual = {}">
                            Adicionar
                            <v-icon right dark>mdi-plus</v-icon>
                        </v-btn>
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-card-text style="height: 200px;">
                        <v-slide-group v-if="projetoAtual.edicoes.length" v-model="edicaoAtual" center-active show-arrows>
                            <v-slide-item v-for="(edicao,n) in projetoAtual.edicoes" :key="n" v-slot:default="{ active, toggle }">
                                <v-card :color="active ? 'primary' : 'grey lighten-1'" class="ma-4" height="100" width="100" @click="toggle">
                                    <v-img :aspect-ratio="16/16" :src="edicao.logo">
                                        <v-row class="fill-height" align="center" justify="center">
                                            <v-scale-transition>
                                                <v-icon v-if="active" color="white" size="48" v-text="'mdi-briefcase-edit'"></v-icon>
                                            </v-scale-transition>
                                        </v-row>
                                    </v-img>
                                </v-card>
                            </v-slide-item>
                        </v-slide-group>
                        <v-alert class="text-center" prominent type="info" text v-else>
                            Não há edições cadastradas no projeto <strong>{{projetoAtual.name}}</strong>
                        </v-alert>
                    </v-card-text>
                </v-card>
            </v-sheet>
        </v-bottom-sheet>
        <FlashMessage :position="'right bottom'"></FlashMessage>
    </div>
</v-app>
</template>
<script> 
    import axios from 'axios';
    import moment from 'moment';
    // import 'bootstrap/dist/css/bootstrap.css'
    import 'bootstrap-vue/dist/bootstrap-vue.css'
    import * as projectService from '../../services/project_service';
    export default {
        props: ['homeRoute', 'listRoute'],
        filters: {
            format_date(value){
                if (value) {
                    moment.locale('pt-br');
                    return moment(String(value)).format('lll');
                }
            },
        },
        data() {
            return {
                projetos: [],
                pagination: {},
                buscaTermo: "",
                isImagem: false,
                edicoesSheet: false,
                projectData: {
                    name: "",
                    logo: ""
                },
                errors: {},
                editProjectData: {},
                thumbnail: { 
                    blank: true, 
                    blankColor: '#777', 
                    width: 75, 
                    height: 75, 
                    class: 'm1' 
                },
                projetoAtual: {
                    name: "",
                    id: null,
                    status: null,
                    edicoes: []
                },
                edicaoAtual:null,
            }
        },
        created() {
            this.getProjetos();
        },
        methods: {
            getProjetos(api_url) {
                let vm = this;
                api_url = api_url || this.$props.listRoute;
                axios.defaults.headers.common = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': window.csrf_token
                };
                axios.get(api_url)
                .then(response => {
                    console.log(response);
                    this.projetos = response.data.data;
                    vm.paginator(response.data);
                });
            },
            createProject: async function() {
                let formData = new FormData();
                formData.append('name', this.projectData.name);
                formData.append('logo', this.projectData.logo);
                formData.append('author_id', document.querySelector('meta[name="user-id"]').getAttribute('content'));

                try {
                    const response = await projectService.createProject(formData);
                    if(response.status === 200){ 
                        this.flashMessage.success({
                            title: 'Sucesso!',
                            message: 'O projeto '+this.projectData.name+' foi adicionado com sucesso!',
                            time: 5000
                        });
                        this.getProjetos();
                        this.hideNewProjectModal();
                    }
                    // this.getProjetos();
                } catch (error) {
                    switch (error.response.status) {
                        case 422:
                            this.errors = error.response.data.errors;
                            break;
                        default:
                            this.flashMessage.error({
                                title: 'Erro!',
                                message: 'Ocorreu algum erro durante o processo! Por favor, tente novamente.',
                                time: 5000
                            });
                            break;
                    }
                }
            },
            deleteProject: async function(project){
                if(!window.confirm(`Você tem certeza que deseja excluir o projeto ${project.name}?`)){
                    return;
                }
                try {
                    await projectService.deleteProject(project.id);
                    this.getProjetos();
                    this.flashMessage.warning({
                        title: 'Sucesso!',
                        message: 'O projeto '+project.name+' foi excluído com sucesso!',
                        time: 5000
                    });
                } catch (error) {
                    this.flashMessage.error({
                        title: 'Ops!',
                        message: error.response.data.message,
                        time: 5000
                    });
                }
            },
            changeStatus: async function(id){
                try {
                    const response = await projectService.statusProject(id);
                    if(response.data.status_type === true){
                        this.flashMessage.success({
                            title: 'Sucesso!',
                            message: response.data.message,
                            time: 5000
                        });
                    } else {
                        this.flashMessage.info({
                            title: 'Sucesso!',
                            message: response.data.message,
                            time: 5000
                        });
                    }
                    this.getProjetos();
                } catch (error) {
                    this.flashMessage.error({
                        title: 'Ops!',
                        message: error.response.data.message,
                        time: 5000
                    });
                }
            },
            paginator(meta) {
                this.pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: meta.next_page_url,
                    prev_page_url: meta.prev_page_url,
                    path: meta.path,
                    total: meta.total,
                    per_page: meta.per_page,
                    to: meta.to
                };
            },
            clearSearch(){
                this.getProjetos();
                this.buscaTermo = "";
                this.$refs.busca.value = "";
            },
            userUrlAlt(event) {
                event.target.src = "/storage/images/user.jpg"
            },
            logoUrlAlt(event) {
                event.target.src = "/storage/images/no_picture.png"
            },
            numberOfPages() {
                if (
                    !this.pagination ||
                    Number.isNaN(parseInt(this.pagination.total)) ||
                    Number.isNaN(parseInt(this.pagination.per_page)) ||
                    this.pagination.per_page <= 0
                ) {
                    return 0;
                }

                const result = Math.ceil(this.pagination.total / this.pagination.per_page)
                return (result < 1) ? 1 : result
            },
            buscaEnviar : function(){
                this.buscaTermo = this.$refs.busca.value;
                this.getProjetos(this.$props.listRoute+'/'+this.$refs.busca.value);
            },
            hideNewProjectModal(){
                this.$refs.newProjectModal.hide();
                this.resetForm();
            },
            showNewProjectModal(){
                this.$refs.newProjectModal.show();
            },
            attachLogo() {
                this.projectData.logo = this.$refs.newProjectLogo.files[0];
                if(this.projectData.logo.type === 'image/jpeg' || this.projectData.logo.type === 'image/png' || this.projectData.logo.type === 'image/webp'){
                    this.isImagem = true;
                    let reader = new FileReader();
                    reader.addEventListener('load', function() {
                        this.$refs.newProjectLogoDisplay.src = reader.result;
                    }.bind(this), false);

                    reader.readAsDataURL(this.projectData.logo);
                }else {
                    this.isImagem = false;
                }
            },
            resetForm() {
                // this.formData = Object.assign({}, this.projectData);
                this.projectData.name = this.projectData.logo = '';
            },
            editProject(project) {
                this.editProjectData = {...project};
                this.showEditProjectModal();
            },
            hideEditProjectModal(){
                this.$refs.editProjectModal.hide();
                this.resetForm();
            },
            showEditProjectModal(){
                this.$refs.editProjectModal.show();
            },
            editAttachLogo() {
                this.editProjectData.logo = this.$refs.editProjectLogo.files[0];
                if(this.editProjectData.logo.type === 'image/jpeg' || this.editProjectData.logo.type === 'image/png' || this.editProjectData.logo.type === 'image/webp'){
                    this.isImagem = true;
                    let reader = new FileReader();
                    reader.addEventListener('load', function() {
                        this.$refs.editProjectLogoDisplay.src = reader.result;
                    }.bind(this), false);

                    reader.readAsDataURL(this.editProjectData.logo);
                }else {
                    this.isImagem = false;
                }
            },
            updateProject: async function(){
                try {
                    const formData = new FormData();
                    formData.append('name', this.editProjectData.name);
                    formData.append('logo', this.editProjectData.logo);
                    formData.append('_method', 'put');

                    const response = await projectService.updateProject(this.editProjectData.id, formData);
                    this.projetos.map(projeto => {
                        if(projeto.id == response.data.id){
                            projeto = response.data;
                        }
                    });
                    this.flashMessage.success({
                        title: 'Sucesso!',
                        message: 'O projeto '+this.editProjectData.name+' foi editado com sucesso!',
                        time: 5000
                    });
                    this.getProjetos();
                    this.hideEditProjectModal();
                } catch (error) {
                    this.flashMessage.error({
                        title: 'Ops!',
                        message: error.response.data.message,
                        time: 5000
                    });
                }
            },
            saveEdition: async function(){

            },
            openEditions(projeto){
                this.edicaoAtual = null;
                this.edicoesSheet = !this.edicoesSheet;
                this.projetoAtual.name = projeto.name;
                this.projetoAtual.edicoes = projeto.edicoes;
            }
        }
    }
</script>