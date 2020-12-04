/**
 * Projeto: amic
 * Arquivo: internal.js
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 04/12/2020 10:05:20 am
 * Last Modified:  04/12/2020 11:29:52 am
 * Modified By: Leonardo Nascimento - <leonardo.nascimento21@gmail.com> / MAC OS
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Leo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */


$('.service-carousel').owlCarousel({
    loop:true,
    nav:true,
    dots: false,
    responsive:{
        0:{
            items:1,
            nav:false,
            dots:true,
            margin:40,
        },
        782:{
            items:3,
            nav:false,
            dots:true,
            margin:40,
        },
        1200:{
            items:4,
            nav:false,
            dots:true,
            margin:40,
        },
        1350:{
            items:4,
            nav:true,
            dots:false,
            margin:40,
        }
    }
})