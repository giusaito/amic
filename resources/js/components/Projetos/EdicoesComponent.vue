<template>
<div>
    <v-expand-transition>
        <!-- <v-sheet v-if="openFormDialog" color="grey lighten-4" height="500" tile> -->
        <v-sheet v-if="openFormDialog" color="grey lighten-4" height="500" tile>
            <v-card>
                <!-- {{projetoAtual.edicoes[edicaoAtual]}} -->
                <!-- <form v-on:submit.prevent="saveEdition"> -->
                <v-form v-on:submit.prevent="createProjectEdition" ref="form" lazy-validation>
                    <v-tabs background-color="white" color="deep-orange accent-4" right>
                        <v-tab>Data da Edição</v-tab>
                        <v-tab>Descrição</v-tab>
                        <v-tab>Logo</v-tab>
                        <v-tab>Foto Destaque</v-tab>
                        <v-tab>Slideshow</v-tab>
                        <v-tab>Fotos</v-tab>
                        <v-tab>Empresas participantes</v-tab>
                        <v-tab-item>
                            <v-container>
                                <v-row>
                                    <v-col cols=12>
                                        <h2>Data inicial / final da edição</h2>
                                        <p>Escolha abaixo a Data/hora inicial e final da edição que está cadastrando / editando.</p>
                                    </v-col>
                                    <v-col cols=12>
                                        <v-datetime-picker label="Data da Edição" v-model="editionData.date_event" dateFormat="dd/MM/yyyy" clearText="Limpar data" locale="pt"></v-datetime-picker>
                                    </v-col>
                                    <v-col cols=12>
                                        <v-datetime-picker label="Data final da Edição" v-model="editionData.date_event_finish" dateFormat="dd/MM/yyyy" clearText="Limpar data"></v-datetime-picker>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-tab-item>
                        <v-tab-item>
                            <v-container>
                                <v-row>
                                    <v-col cols=12 >
                                        <v-label>Descrição da Edição</v-label>
                                        <ckeditor :editor="editor" v-model="editionData.description" :config="editorConfig"></ckeditor>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-tab-item>
                        <v-tab-item>
                            <v-container>
                                <v-row>
                                    <v-col cols=12>
                                        <h2>Logomarca da Edição</h2>
                                        <p>Envie abaixo a Imagem que será a logomarca desta edição.</p>
                                    </v-col>
                                    <foto-component textUpload="Enviar Logo" id="logo"></foto-component>
                                </v-row>
                            </v-container>
                        </v-tab-item>
                        <v-tab-item>
                            <v-container>
                                <v-row>
                                    <v-col cols=12>
                                        <h2>Foto destaque</h2>
                                        <p>Envie abaixo a Foto destaque que será exibida na página desta edição.</p>
                                    </v-col>
                                    <foto-component textUpload="Enviar Foto destaque" id="starring-photo"></foto-component>
                                </v-row>
                            </v-container>
                        </v-tab-item>
                        <v-tab-item>
                            <v-container>
                                <v-row>
                                    <foto-multiple-component :images="images.slideshow" @arrayimagens="pushArrayImagens" galeria="slideshow"></foto-multiple-component>
                                </v-row>
                            </v-container>
                        </v-tab-item>
                        <v-tab-item>
                            <v-container>
                                <v-row>
                                    <foto-multiple-component :images="images.fotos" @arrayimagens="pushArrayImagens" galeria="fotos"></foto-multiple-component>
                                </v-row>
                            </v-container>
                        </v-tab-item>
                        <v-tab-item>
                            <v-container>
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
        <!-- <v-btn class="mt-1 float-right close-bottom-sheet" text color="link" @click="edicoesSheet = !edicoesSheet" small> -->
        <v-btn class="mt-1 float-right close-bottom-sheet" text color="link" @click="closeBottomSheet" small>
            <v-icon small>mdi mdi-close</v-icon>fechar
        </v-btn>
        <v-card>
            <v-card-title>
                {{projetoAtual.name}} 
                <v-btn rounded small color="blue-grey" class="ma-2 white--text" @click="openDialog('add')">
                    Adicionar
                    <v-icon right dark>mdi-plus</v-icon>
                </v-btn>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text style="height: 200px;">
                <v-slide-group v-if="projetoAtual.edicoes.length" v-model="edicaoAtual" @change="openDialog('edit')" center-active show-arrows>
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
</div>
</template>
<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import * as projectEditionService from '../../services/project_edition_service';
    import moment from 'moment';
    export default {
        props: {
            'projetoAtual': Object,
        },
        data() {
            return {
                editor: ClassicEditor,
                editorData: '',
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
                edicoesSheet: false,
                edicaoAtual:null,
                openFormDialog: false,
                images: {
                    slideshow: [],
                    fotos: [] 
                }
            }
        },
        methods: {
            openDialog($param) {
                this.openFormDialog = true;
                // if(this.projetoAtual.edicoes[this.edicaoAtual]){
                if($param === 'add') {

                    this.openCreateForm();
                }else {
                    this.openEditForm();
                }
            },
            createProjectEdition: async function(){
                let formData = new FormData();
                formData.append('logo', this.editionData.logo);
                formData.append('description', this.editionData.description);
                formData.append('starring_photo', this.editionData.starring_photo);
                formData.append('date_event', this.editionData.date_event);
                formData.append('date_event_finish', this.editionData.date_event_finish);
                formData.append('author_id', document.querySelector('meta[name="user-id"]').getAttribute('content'));

                try {
                    const response = await projectEditionService.createProjectEdition(formData);
                    if(response.status === 200){ 
                        this.flashMessage.success({
                            title: 'Sucesso!',
                            message: 'A Edição '+this.editionData.date_event+' foi adicionado com sucesso!',
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
            openCreateForm() {
                this.openFormDialog = true;
                this.editionData = {
                    logo: "",
                    description: "",
                    starring_photo: "",
                    date_event: new Date(),
                    date_event_finish: new Date(),
                    author_id: ""
                };
            },
            openEditForm() {
                this.openFormDialog = true;
                // console.log(this.projetoAtual.edicoes[this.edicaoAtual]);
                this.editionData.description = this.projetoAtual.edicoes[this.edicaoAtual]['description'];
                this.editionData.date_event = new Date(this.projetoAtual.edicoes[this.edicaoAtual]['date_event']);
                this.editionData.date_event_finish = new Date(this.projetoAtual.edicoes[this.edicaoAtual]['date_event_finish']);
                // this.editionData.date_event = moment(this.projetoAtual.edicoes[this.edicaoAtual]['date_event']).format('DD/MM/YYYY hh:mm');

            },
            closeBottomSheet() {
                // this.$emit('edicoesSheet', false);
                this.$emit('fechar', true)
            },
            pushArrayImagens(value){
                console.log('oiiiii');
                console.log(value);
                console.log('oiiiii');
            }
        }
    }
</script>
<style>
.ck-editor .ck-editor__main .ck-content {
    min-height: 300px;
}
.v-tabs-items {
    height: 452px !important;
    overflow: auto !important;
    /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#dadada+0,dadada+100;Blue+Grey+Flat */
    background: #dadada; /* Old browsers */
    background: -moz-linear-gradient(top,  #dadada 0%, #dadada 100%); /* FF3.6-15 */
    background: -webkit-linear-gradient(top,  #dadada 0%,#dadada 100%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(to bottom,  #dadada 0%,#dadada 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#dadada', endColorstr='#dadada',GradientType=0 ); /* IE6-9 */
}
.v-tabs-bar {
    -webkit-box-shadow: 0px 10px 10px 0px rgba(0,0,0,0.15) !important;
    -moz-box-shadow: 0px 10px 10px 0px rgba(0,0,0,0.15) !important;
    box-shadow: 0px 10px 10px 0px rgba(0,0,0,0.15) !important;
    z-index:1 !important;
}
.v-slide-item--active .v-responsive__content:after {
    content: "";
    position: absolute;
    background: rgb(255 94 0 / 50%);
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}
/* .v-tabs-items .v-label, .v-tabs-items .v-input, .v-tabs-items .v-input input, .v-tabs-items .v-input textarea {
    color:#fff !important;
} */
.v-slide-item--active .v-responsive__content .v-icon {
    z-index: 2;
}
</style>