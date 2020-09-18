<template>
<div>
    <v-expand-transition>
        <v-sheet v-if="edicaoAtual != null" color="grey lighten-4" height="500" tile>
            <!-- <v-row class="fill-height" align="center" justify="center">
                <v-col cols="10">
                    <h3 class="title">{{projetoAtual.edicoes[edicaoAtual]}}</h3>
                </v-col>
            </v-row> -->
            <v-card>
                {{projetoAtual.edicoes[edicaoAtual]}}
                <!-- <form v-on:submit.prevent="saveEdition"> -->
                <v-form v-on:submit.prevent="saveEdition" ref="form" lazy-validation>
                    <v-tabs background-color="white" color="deep-orange accent-4" right>
                        <v-tab>Detalhes da Edição</v-tab>
                        <v-tab>Slideshow</v-tab>
                        <v-tab>Fotos</v-tab>
                        <v-tab>Empresas participantes</v-tab>
                        <v-tab-item>
                            <v-container fluid>
                                <v-row>
                                    <v-col cols=12 >
                                        <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
                                    </v-col>
                                </v-row>
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
</div>
</template>
<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    export default {
        props: ['projetoAtual', 'edicaoAtual'],
        data() {
            return {
                editor: ClassicEditor,
                editorData: '',
                editorConfig: {
                    language: 'pt',
                    indent_style: 'tab',
                    tab_width: 4,
                }
            }
        },
        methods: {
            
            saveEdition: async function(){

            },
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
    background: rgb(242,245,246) !important; /* Old browsers */
    background: -moz-linear-gradient(top,  rgba(242,245,246,1) 0%, rgba(227,234,237,1) 37%, rgba(200,215,220,1) 100%) !important; /* FF3.6-15 */
    background: -webkit-linear-gradient(top,  rgba(242,245,246,1) 0%,rgba(227,234,237,1) 37%,rgba(200,215,220,1) 100%) !important; /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(to bottom,  rgba(242,245,246,1) 0%,rgba(227,234,237,1) 37%,rgba(200,215,220,1) 100%) !important; /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f5f6', endColorstr='#c8d7dc',GradientType=0 ) !important; /* IE6-9 */

}
.v-tabs-bar {
    -webkit-box-shadow: 0px 10px 10px 0px rgba(0,0,0,0.15) !important;
    -moz-box-shadow: 0px 10px 10px 0px rgba(0,0,0,0.15) !important;
    box-shadow: 0px 10px 10px 0px rgba(0,0,0,0.15) !important;
    z-index:1 !important;
}
</style>