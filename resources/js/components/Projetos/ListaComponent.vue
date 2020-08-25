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
    {{ $token }}
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
            // axios.defaults.headers.common["Authorization"] = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMjNhNDhjYTdmY2JkYTJmZTYyMzZhOGM2YWUxZmRkNGI0Y2NlYTQ5MjJiZjgzYjBhMDUxNmQ0MDdhZWY4NmRmNGJjNWFjYTNlMmUwYjFlMjAiLCJpYXQiOjE1OTgzNTk0NjEsIm5iZiI6MTU5ODM1OTQ2MSwiZXhwIjoxNjI5ODk1NDYxLCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.QL3dpZxwdMFqQSn2qTudIurY_A6mAzURs5UfWFetK_4aDxv3T5Z-bvYXEgZe6-9tg7_oGH9Bstgeh3UBmv2BcXK3AvU6iujV6gb3N2SrDui8bAkZ5SzqGQdDrvZQ0G-a3NaT6GgME_1qyb6qzs-X8iNPHs8v5fH77hKs6D2xu0W_SpJU-vtfChkCO4bSfiirdfrMfB9b8P_bf5SJ5M-mJXZRcIaMXLjwAJlrugTpSQVnU7kLxhBrwT3BgXBxf3p_GSUsHC7LJRS1i-rhpj5dt1kPJOA2p1HnkiwQSqYeFUmjHQoHDLU-DKo1hPz7SgVdwzFI43_MZJnHO8mek3QjmOpFA9t1pIvO_uNMBzEeH_V1137oVMuGuo4ekGdpc12Z2T41lT-MucMj8dHnjPOS5VTWzDmrXM8rcddg-cWmjN5EbOZzrmm6839ysCLNhSZepLawMQJgJAuuuITlT4AV7OdYmzCDzcz7igKeWyYEdYSg9xhZmlHHJDVKFHBPPlg-Flarcl1BGsAvHd7EADtOZsqnzIaTK6wSiGJ_aDNRpvJPQHsuhOmcJfgMw6IDlmNhe80-m913PdtLiufDnM4ZtJe53R5SGkFviGkxaqaQbde8N9Ua3xK54xSat85zo48jZK7xrx8rG60Pmlt8Ngv6y8G_vaKspzbUaTHYF65qepc",
            // axios.defaults.headers.common["Accept"] = "*/*";
            axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': window.csrf_token
            };
            axios
                .get('/api/auth/painel/projetos')
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
                    .delete(`/api/auth/painel/projeto/excluir/${id}`)
                    .then(response => {
                        let i = this.projetos.map(item => item.id).indexOf(id);
                        this.projetos.splice(i, 1)
                    });
            }
        }
    }
</script>