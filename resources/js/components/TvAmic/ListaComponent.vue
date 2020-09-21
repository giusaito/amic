<template>
  <v-app>
    <div id="container">
      <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
          <h2>Tv Amic</h2>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a :href="homeRoute">Painel</a>
            </li>
            <li class="breadcrumb-item active">
              <strong>Tv Amic</strong>
            </li>
          </ol>
        </div>
      </div>
      <div class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox">
              <div class="ibox-title">
                <h5>Lista de vídeos cadastrados</h5>
                <div class="ibox-tools">
                  <button type="button" class="btn btn-primary btn-xs" v-on:click="showNewModal">Adicionar vídeo</button>
                </div>
              </div>
                <b-overlay :show="show"
                      spinner-variant="primary"
                      spinner-type="grow"
                      spinner-small
                      rounded="sm">
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
                              <tr v-for="tv in tvAmic" :key="tv.id">
                                <td class="project-status" @click="changeStatus(tv.id)" style="cursor:pointer;">
                                  <span v-if="tv.status === 'PUBLISHED'" class="label label-primary">Ativo</span>
                                  <span v-if="tv.status === 'DRAFT'" class="label label-default">Inativo</span>
                                </td>
                                <td class="project-title">
                                  <a href="project_detail.html">{{ tv.title }}</a>
                                  <br>
                                  <small>Adicionado em {{ tv.created_at | format_date }}</small>
                                </td>
                                <td class="project-people">
                                  <div class="lightBoxGallery">
                                    <!-- <a v-if="projeto.logo" :href="'/storage/images/projects/logo/'+projeto.logo" :title="projeto.name" data-gallery="">
                                      <img :src="'/storage/images/projects/logo/'+projeto.logo" @error="logoUrlAlt">
                                      </a> -->
                                    <!-- <img v-else :src="'/storage/images/projects/logo/'+projeto.logo" @error="logoUrlAlt"> -->
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
                                  <!-- <small><strong><a href="" v-b-tooltip.hover :title="tv.user.name"><img alt="image" class="rounded-circle" :src="'/storage/images/avatars/'+tv.user.id+'/avatar.png'" @error="userUrlAlt"></a></strong></small> -->
                                </td>
                                <td class="project-actions">
                                  <a href="#" class="btn btn-white btn-sm" v-on:click="editProject(projeto)"><i class="fa fa-pencil"></i> Editar </a>
                                  <button class="btn btn-danger" v-on:click="deleteProject(tv)">Excluir</button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </b-overlay>
                </div>
            </div>
        </div>
      </div>
      <b-modal id="modal-xl" size="xl" ref="NewModal" hide-footer title="Adicionar vídeo">
        <div v-show="displayProcess">
          <form v-on:submit.prevent="processVideo">
            <div class="form-group">
              <label for="url_video">Url do vídeo</label>
              <b-input type="url" required="required" v-model="infoData.url_video" id="url_video" placeholder="Insira a url do vídeo"  :counter="191"/>
              <b-form-invalid-feedback :force-show="true" v-if="errors.url_video">{{errors.url_video[0]}}</b-form-invalid-feedback>
            </div>
            <hr>
            <div class="text-right">
              <button type="button" class="btn btn-default" v-on:click="hideNewModal">Cancelar</button>
              <button type="submit" class="btn btn-primary" :disabled="ProcessVideoAnimation">
                <v-progress-circular v-show="ProcessVideoAnimation" indeterminate color="amber" :size="15"></v-progress-circular>
                Processar vídeo
              </button>
            </div>
          </form>
        </div>
        <div v-show="displayForm">
          <form v-on:submit.prevent="createProject">
            <div class="form-group">
              <label for="title">Título</label>
              <b-input type="text" required="required" v-model="infoData.title" id="title" placeholder="Insira a url do vídeo"  :counter="191"/>
              <b-form-invalid-feedback :force-show="true" v-if="errors.title">{{errors.title[0]}}</b-form-invalid-feedback>
            </div>
            <div class="form-group">
              <label for="description">Descrição</label>
              <b-input type="text" required="required" v-model="infoData.description" id="description" placeholder="Insira a descrição do vídeo"  :counter="191"/>
              <b-form-invalid-feedback :force-show="true" v-if="errors.description">{{errors.description[0]}}</b-form-invalid-feedback>
            </div>
            <div class="form-group">
              <label for="iframe">Iframe</label>
              <b-input type="text" required="required" v-model="infoData.iframe" id="iframe" placeholder="Insira o iframe do vídeo"  :counter="191"/>
              <b-form-invalid-feedback :force-show="true" v-if="errors.iframe">{{errors.iframe[0]}}</b-form-invalid-feedback>
            </div>
            <div class="form-group">
              <label for="width">Width</label>
              <b-input type="text" required="required" v-model="infoData.width" id="width" placeholder="Insira o width do vídeo"  :counter="191"/>
              <b-form-invalid-feedback :force-show="true" v-if="errors.width">{{errors.width[0]}}</b-form-invalid-feedback>
            </div>
            <div class="form-group">
              <label for="height">height</label>
              <b-input type="text" required="required" v-model="infoData.height" id="height" placeholder="Insira o height do vídeo"  :counter="191"/>
              <b-form-invalid-feedback :force-show="true" v-if="errors.height">{{errors.height[0]}}</b-form-invalid-feedback>
            </div>
            <div class="form-group">
              <label for="provider_name">Nome do provedor de vídeo</label>
              <b-input type="text" required="required" v-model="infoData.provider_name" id="provider_name" placeholder="Insira o provider_name do vídeo"  :counter="191"/>
              <b-form-invalid-feedback :force-show="true" v-if="errors.provider_name">{{errors.provider_name[0]}}</b-form-invalid-feedback>
            </div>
            <div class="form-group">
              <label for="provider_url">Url do provedor</label>
              <b-input type="text" required="required" v-model="infoData.provider_url" id="provider_url" placeholder="Insira o provider_url do vídeo"  :counter="191"/>
              <b-form-invalid-feedback :force-show="true" v-if="errors.provider_url">{{errors.provider_url[0]}}</b-form-invalid-feedback>
            </div>
            <div class="form-group">
                <label for="name">Miniatura</label>
                <b-row>
                    <b-col cols="3" v-if="isImagem">
                        <img class="img-thumbnail img-fluid" src="" ref="newProjectLogoDisplay">
                    </b-col>
                    <b-col>
                        <input type="file" v-on:change="attachLogo" ref="newProjectLogo" class="form-control" id="logo" />
                        <b-form-invalid-feedback :force-show="true" v-if="errors.logo">{{errors.logo[0]}}</b-form-invalid-feedback>
                    </b-col>
                </b-row>
            </div>
            <div class="form-group">
              <label for="statusVideo">statusVideo</label>
              <b-input type="text" required="required" v-model="infoData.statusVideo" id="statusVideo" placeholder="Insira o status do vídeo"  :counter="191"/>
              <b-form-invalid-feedback :force-show="true" v-if="errors.statusVideo">{{errors.statusVideo[0]}}</b-form-invalid-feedback>
            </div>
            <hr>
            <div class="text-right">
              <button type="button" class="btn btn-default" v-on:click="hideNewModal">Cancelar</button>
              <button type="submit" class="btn btn-primary" :disabled="ProcessVideoAnimation">
                <v-progress-circular v-show="ProcessVideoAnimation" indeterminate color="amber" :size="15"></v-progress-circular>
                Salvar
              </button>
            </div>
          </form>
        </div>
      </b-modal>
      <FlashMessage :position="'right bottom'"></FlashMessage>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="text-center">
      <div class="btn-group">
        <button type="button" @click="getTvAmic(pagination.prev_page_url)" v-bind:class="[{disabled: !pagination.prev_page_url}]" class="btn btn-white"><i class="fa fa-chevron-left"></i></button>
        <button type="button" class="btn btn-white" v-for="pageNumber in numberOfPages()" v-bind:key="pageNumber" :class="{'active':(pagination.current_page === pageNumber)}" @click="getTvAmic(pagination.path+'?page='+pageNumber)"> {{pageNumber}} </button>
        <button type="button" @click="getTvAmic(pagination.next_page_url)" v-bind:class="[{disabled: !pagination.next_page_url}]" class="btn btn-white"><i class="fa fa-chevron-right"></i> </button>
      </div>
    </div>
  </v-app>
</template>

<script>
    import axios from 'axios';
    import moment from 'moment';
    import 'bootstrap-vue/dist/bootstrap-vue.css'
    import * as tvAmicService from '../../services/tv_amic_service';
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
                show: false,
                isImagem: false,
                ProcessVideoAnimation: false,
                displayProcess: true,
                displayForm: false,
                tvAmic: [],
                pagination: {},
                buscaTermo: "",
                isImagem: false,
                edicoesSheet: false,
                projectData: {
                    name: "",
                    logo: ""
                },
                infoData: {
                    url_video: "",
                    title: "",
                    description: "",
                    image: "",
                    iframe: "",
                    width: "",
                    height: "",
                    provider_name: "",
                    provider_url: "",
                    license: "",
                    statusVideo: "",
                    author_id: "",
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
            this.getTvAmic();
        },
        methods: {
            showNewModal(){
                this.$refs.NewModal.show();
            },
            hideNewModal(){
                this.$refs['NewModal'].hide();
                this.resetForm();
                this.displayProcess = true;
                this.displayForm = false;
            },
            resetForm(){
                this.infoData.url_video = "";
                this.infoData.title = "";
                this.infoData.description = "";
                this.infoData.iframe = "";
                this.infoData.image = "";
                this.infoData.license = "";
                this.infoData.provider_name = "";
                this.infoData.provider_url = "";
                this.infoData.width = "";
                this.infoData.height = "";
                this.infoData.author_id = "";
            },
            processVideo: async function(){
                this.ProcessVideoAnimation = true;
                let formData = new FormData();
                formData.append('url_video', this.infoData.url_video);
                 try {
                    const response =  await tvAmicService.processVideo(formData);
                    if(response.status === 200){
                        this.infoData.title = response.data.title;
                        this.infoData.description = response.data.description;
                        this.infoData.iframe = response.data.iframe;
                        this.infoData.image = response.data.image;
                        this.infoData.license = response.data.license;
                        this.infoData.provider_name = response.data.provider_name;
                        this.infoData.provider_url = response.data.provider_url;
                        this.infoData.width = response.data.width;
                        this.infoData.height = response.data.height;
                        this.infoData.author_id = response.data.author_id;
                        this.ProcessVideoAnimation = false;
                        this.displayProcess = false;
                        this.displayForm = true;
                        this.flashMessage.success({
                            title: 'Sucesso!',
                            message: 'O vídeo '+response.data.title+' foi processado com sucesso!',
                            time: 5000
                        });
                        this.hideNewProjectModal();
                    }
                    // this.getTvAmic();
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
            hideNewProjectModal(){
                this.$refs.editProjectModal.hide();
                this.resetForm();
            },
            getTvAmic(api_url) {
                let vm = this;
                api_url = api_url || this.$props.listRoute;
                axios.defaults.headers.common = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': window.csrf_token
                };
                axios.get(api_url)
                .then(response => {
                    this.tvAmic = response.data.data;
                    vm.paginator(response.data);
                });

            },
            createProject: async function() {
                let formData = new FormData();
                formData.append('url_video', this.infoData.url_video);
                formData.append('title', this.infoData.title);
                formData.append('description', this.infoData.description);
                formData.append('iframe', this.infoData.iframe);
                formData.append('width', this.infoData.width);
                formData.append('height', this.infoData.height);
                formData.append('provider_name', this.infoData.provider_name);
                formData.append('provider_url', this.infoData.provider_url);
                formData.append('license', this.infoData.license);
                formData.append('statusVideo', this.infoData.statusVideo);
                formData.append('author_id', document.querySelector('meta[name="user-id"]').getAttribute('content'));
                    try {
                    const response = await tvAmicService.createTvAmic(formData);
                    if(response.status){
                        this.hideNewModal();
                        this.flashMessage.success({
                            title: 'Sucesso!',
                            message: 'O vídeo '+this.infoData.title+ ' foi adicionado com sucesso!',
                            time: 5000
                        });
                        this.getTvAmic();
                        this.hideNewProjectModal();
                    }
                    // this.getTvAmic();
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
            deleteProject: async function(tv){
                if(!window.confirm(`Você tem certeza que deseja excluir o vídeo ${tv.title}?`)){
                    return;
                }
                try {
                    this.show = true;
                    await tvAmicService.deleteTvAmic(tv.id);
                    this.getTvAmic();
                    this.flashMessage.success({
                        title: 'Sucesso!',
                        message: 'O vídeo '+tv.title+' foi excluído com sucesso!',
                        time: 5000
                    });
                } catch (error) {
                    this.flashMessage.error({
                        title: 'Ops!',
                        message: error.response.data.message,
                        time: 5000
                    });
                }
               this.show = false;
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
                this.getTvAmic(this.$props.listRoute+'/'+this.$refs.busca.value);
            },
             clearSearch(){
                this.getTvAmic();
                this.buscaTermo = "";
                this.$refs.busca.value = "";
            },
        }
    }
</script>