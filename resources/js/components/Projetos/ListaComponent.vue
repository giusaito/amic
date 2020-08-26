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
                                            <span class="label label-primary">Active</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">Contract with Zender Company</a>
                                            <br>
                                            <small>Created 14.08.2014</small>
                                        </td>
                                        <td class="project-completion">
                                                <small>Completion with: 48%</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-people">
                                            <a href=""><img alt="image" class="rounded-circle" src="img/a3.jpg"></a>
                                            <a href=""><img alt="image" class="rounded-circle" src="img/a1.jpg"></a>
                                            <a href=""><img alt="image" class="rounded-circle" src="img/a2.jpg"></a>
                                            <a href=""><img alt="image" class="rounded-circle" src="img/a4.jpg"></a>
                                            <a href=""><img alt="image" class="rounded-circle" src="img/a5.jpg"></a>
                                        </td>
                                        <td class="project-actions">
                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                            <!-- <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a> -->
                                            <router-link :to="{name: 'edit', params: { id: projeto.id }}" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar
                                            </router-link>
                                            <button class="btn btn-danger" @click="deletePost(post.id)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
    export default {
        props: ['homeRoute'],
        data() {
            return {
                projetos: []
            }
        },
        created() {
            axios
                .get('/api/painel/projetos')
                .then(response => {
                    this.projetos = response.data;
                });
            // this.$http.get('/api/painel/projetos').then((response) => {
            //     this.projetos = response.data;
            // })
        },
        methods: {
            deleteProjeto(id) {
                this.axios
                    .delete(`/api/painel/projeto/excluir/${id}`)
                    .then(response => {
                        let i = this.projetos.map(item => item.id).indexOf(id);
                        this.projetos.splice(i, 1)
                    });
            }
        }
    }
</script>