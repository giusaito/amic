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
    <div class="wrapper wrapper-content animated fadeInUp">
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
                                <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> Atualizar</button>
                            </div>
                            <div class="col-md-11">
                                <div class="input-group"><input type="text" placeholder="Buscar" class="form-control-sm form-control"> <span class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-primary"> OK</button> </span></div>
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
                                        <td class="project-people tooltip-screen" ref="tooltip">
                                                <small><strong><a href="" v-b-tooltip.hover :title="projeto.user.name"><img alt="image" class="rounded-circle" :src="'/storage/images/avatars/'+projeto.user.id+'/avatar.png'" @error="imageUrlAlt"></a></strong></small>
                                        </td>
                                        <td class="project-people">
                                            <a href=""><img alt="image" class="rounded-circle" src="img/a3.jpg"></a>
                                            <a href=""><img alt="image" class="rounded-circle" src="img/a1.jpg"></a>
                                            <a href=""><img alt="image" class="rounded-circle" src="img/a2.jpg"></a>
                                            <a href=""><img alt="image" class="rounded-circle" src="img/a4.jpg"></a>
                                            <a href=""><img alt="image" class="rounded-circle" src="img/a5.jpg"></a>
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
                                <a  href="#" @click="getProjetos(pagination.prev_page_url)" v-bind:class="[{disabled: !pagination.prev_page_url}]" class="btn btn-white"><i class="fa fa-chevron-left"></i></a>
                                <a href="" class="btn btn-white">1</a>
                                <a href="" class="btn btn-white  active">2</a>
                                <a href="" class="btn btn-white">3</a>
                                <a href="" class="btn btn-white">4</a>
                                <a href="" class="btn btn-white">5</a>
                                <a href="" class="btn btn-white">6</a>
                                <a href="" class="btn btn-white">7</a>
                                <a  href="#" @click="getProjetos(pagination.next_page_url)" v-bind:class="[{disabled: !pagination.next_page_url}]" class="btn btn-white"><i class="fa fa-chevron-right"></i> </a>
                            </div>
                            <!-- <ul class="pagination justify-content-center">
                                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                    <a class="page-link" href="#" @click="getProjetos(pagination.prev_page_url)">Previous</a>
                                </li>
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">{{ pagination.current_page }} of {{ pagination.last_page }}</a>
                                </li>
                                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                    <a class="page-link" href="#" @click="getProjetos(pagination.next_page_url)">Next</a>
                                </li>
                            </ul> -->
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
                pagination: {}
            }
        },
        created() {
            axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': window.csrf_token
            };
            axios.get(this.$props.listRoute).then(response => {
                this.projetos = response.data.data;
            });
            this.getProjetos();
        },
        methods: {
            getProjetos(api_url) {
                let vm = this;
                api_url = api_url || this.$props.listRoute;
                // fetch(api_url)
                //     .then(function(response) {
                //         return response.json();
                //     })
                //     .then(response => {
                //         this.projetos = response.data.data;
                //         // vm.paginator(response.meta, response.links);
                //         vm.paginator(response);
                //     })
                //     .catch(err => console.log(err));
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
            // paginator(meta, links) {
            paginator(meta) {
                this.pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: meta.next_page_url,
                    prev_page_url: meta.prev_page_url
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
            tooltip(){
                jQuery(this.$refs.tooltip).tooltip({
                    selector: "[data-toggle=tooltip]",
                    container: "body"
                });
            }
        },
        mounted(){
            
        }
    }
</script>