<template>
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
                            <a href="" class="btn btn-primary btn-xs">Criar novo projeto</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row m-b-sm m-t-sm">
                            <div class="col-md-1">
                                <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" @click="getProjetos(pagination.path+'?page='+pagination.current_page)"><i class="fa fa-refresh"></i> Atualizar</button>
                            </div>
                            <div class="col-md-11">
                                <div class="input-group">
                                    <input type="text" placeholder="Buscar" class="form-control-sm form-control" ref="busca"> 
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary" v-on:click="buscaEnviar"> OK</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="project-list">
                            <table class="table table-hover">
                                <tbody>
                                    <tr v-for="projeto in projetos" :key="projeto.id">
                                        <td class="project-status">
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
                                                <a :href="'/storage/images/projects/logo/'+projeto.logo" :title="projeto.name" data-gallery=""><img :src="'/storage/images/projects/logo/'+projeto.logo"></a>
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
                                                <small><strong><a href="" v-b-tooltip.hover :title="projeto.user.name"><img alt="image" class="rounded-circle" :src="'/storage/images/avatars/'+projeto.user.id+'/avatar.png'" @error="imageUrlAlt"></a></strong></small>
                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> Visualizar </a>
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar </a>
                                            <!-- <router-link :to="{name: 'edit', params: { id: projeto.id }}" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar
                                            </router-link> -->
                                            <button class="btn btn-danger" @click="deletePost(projeto.id)">Excluir</button>
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
</div>
</template>
<script> 
    import axios from 'axios';
    import moment from 'moment';
    import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
    Vue.use(BootstrapVue)
    Vue.use(IconsPlugin)
    // import 'bootstrap/dist/css/bootstrap.css'
    import 'bootstrap-vue/dist/bootstrap-vue.css'
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
                buscaTermo: ""
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
            deleteProjeto(id) {
                this.axios
                    .delete(`/api/auth/painel/projeto/excluir/${id}`)
                    .then(response => {
                        let i = this.projetos.map(item => item.id).indexOf(id);
                        this.projetos.splice(i, 1)
                    });
            },
            imageUrlAlt(event) {
                event.target.src = "/storage/images/user.jpg"
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
                this.$refs.busca.value;
                this.getProjetos(this.$props.listRoute+'/'+this.$refs.busca.value);
            }
        }
    }
</script>