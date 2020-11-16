<?php
/*
 * Projeto: amic
 * Arquivo: sidebar.blade.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 11/11/2020 9:30:00 am
 * Last Modified:  11/11/2020 10:28:06 am
 * Modified By: Leonardo Nascimento - <leonardo.nascimento21@gmail.com> / MAC OS
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Leo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */


?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">Example user</span>
                        <span class="text-muted text-xs block">menu <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="{{ (request()->is('/')) ? 'active' : '' }}">
                <a href="{{route('backend.index')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Painel</span></a>
            </li>
            <li class="{{ (request()->is('painel/projetos*')) ? 'active' : '' }}">
                <a href="{{route('backend.projetos.index')}}"><i class="fa fa-list-alt"></i> <span class="nav-label">Projetos</span></a>
            </li>
            <li class="{{ (request()->is('painel/noticia*')) ? 'active' : '' }}">
                <a href="{{route('backend.noticia.index')}}"><i class="fa fa-list-alt"></i> <span class="nav-label">Notícias</span></a>
            </li>
            <li class="{{ (request()->is('painel/categoria/site-util*')) ? 'active' : '' }}">
                <a href="{{route('backend.category.site.index')}}"><i class="fa fa-link"></i> <span class="nav-label">Categoria Sites Úteis</span></a>
            </li>
            <li class="{{ (request()->is('painel/site-util*')) ? 'active' : '' }}">
                <a href="{{route('backend.site-util.index')}}"><i class="fa fa-link"></i> <span class="nav-label">Sites Úteis</span></a>
            </li>
            <li class="{{ (request()->is('painel/tv-amic*')) ? 'active' : '' }}">
                <a href="{{route('backend.tv-amic.index')}}"><i class="fa fa-tv"></i> <span class="nav-label">TV amic</span></a>
            </li>
            <li class="{{ (request()->is('painel/podcast*')) ? 'active' : '' }}">
                <a href="{{route('backend.podcast.index')}}"><i class="fa fa-play-circle"></i> <span class="nav-label">Podcast</span></a>
            </li>
            <li class="{{ (request()->is('painel/evento*')) ? 'active' : '' }}">
                <a href="{{route('backend.evento.index')}}"><i class="fa fa-calendar"></i> <span class="nav-label">Eventos</span></a>
            </li>
            <li class="{{ (request()->is('painel/patrocinador*')) ? 'active' : '' }}">
                <a href="{{route('backend.patrocinador.index')}}"><i class="fa fa-money"></i> <span class="nav-label">Patrocinador</span></a>
            </li>
            <li>
            </li>
        </ul>

    </div>
</nav>