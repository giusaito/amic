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
                                <div class="row">
                                    <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Sign in</h3>
                                        <p>Sign in today for more expirience.</p>
                                        <form role="form">
                                            <div class="form-group"><label>Email</label> <input type="email" placeholder="Enter email" class="form-control"></div>
                                            <div class="form-group"><label>Password</label> <input type="password" placeholder="Password" class="form-control"></div>
                                            <div>
                                                <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>Log in</strong></button>
                                                <label> <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Remember me </label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-sm-6"><h4>Not a member?</h4>
                                        <p>You can create an account:</p>
                                        <p class="text-center">
                                            <a href=""><i class="fa fa-sign-in big-icon"></i></a>
                                        </p>
                                    </div>
                                </div>
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
    export default {
        props: ['homeRoute', 'projetosRoute', 'projeto'],
        data() {
            return {
            }
        }
    }
</script>