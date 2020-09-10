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
                    </div>
                </div>
            </div>
        </div>
        <b-modal ref="NewModal" hide-footer title="Adicionar vídeo">
            <div class="d-block">
                <form v-on:submit.prevent="processVideo">
                    <div class="form-group">
                        <label for="url_video">Url do vídeo</label>
                        <b-input v-model="infoData.url_video" id="url_video" placeholder="Insira a url do vídeo"  :counter="191"/>
                        <b-form-invalid-feedback :force-show="true" v-if="errors.url_video">{{errors.url_video[0]}}</b-form-invalid-feedback>
                    </div>
                    <hr>
                    <div class="text-right">
                        <button type="button" class="btn btn-default" v-on:click="hideNewModal">Cancelar</button>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span>Processar vídeo</button>
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
                projetos: [],
                pagination: {},
                buscaTermo: "",
                isImagem: false,
                edicoesSheet: false,
                infoData: {
                    url_video: "",
                    name: ""
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
                this.$refs.hideNewModal.hide();
                this.resetForm();
            },
            processVideo: async function(){
                let formData = new FormData();
                formData.append('url_video', this.infoData.url_video);
                console.log(this.infoData.url_video);
                 try {
                    const response =  await tvAmicService.processVideo(formData);
                    if(response.status === 200){ 
                        console.log(response.data);
                        this.flashMessage.success({
                            title: 'Sucesso!',
                            message: 'O projeto '+this.projectData.name+' foi adicionado com sucesso!',
                            time: 5000
                        });
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
            getTvAmic(api_url) {
                let vm = this;
                api_url = api_url || this.$props.listRoute;
                axios.defaults.headers.common = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': window.csrf_token
                };
                axios.get(api_url)
                .then(response => {
                    this.projetos = response.data.data;
                });
            },
            createProject() {
                let formData = new FormData();
                formData.append('name', this.projectData.name);
                formData.append('logo', this.projectData.logo);
                formData.append('author_id', document.querySelector('meta[name="user-id"]').getAttribute('content'));
            },
            
        }
    }
</script>