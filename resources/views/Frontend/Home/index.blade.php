@extends('Frontend.Layout.amic')
@section('title', ' PR')
@section('content')
<div id="root">
  @include('Frontend.Layout.Includes.header')
  <!-- SLIDESHOW -->
  <div class="slider-area">
    <div class="slider-active owl-carousel nav-style-1 owl-dot-none">
      <div class="slider-height d-flex align-items-center bg-img">
        <img src="_TMP/slide_1.jpg" alt="">
        <div class="container">
          <div class="row">
            <div class="col-xl-6 col-lg-12 col-md-12 col-12 col-sm-12 offset-xl-3 d-flex align-items-center text-center">
              <div class="single-slider">
                <div class="slider-content slider-animated">
                  <h3 class="animated">Micro e pequenas empresas ganham isenção em taxas para participar de licitações no Paraná </h3>
                  <div class="slider-btn btn-hover">
                    <a class="animated" href="#">LEIA MAIS</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="slider-height d-flex align-items-center bg-img">
        <img src="_TMP/slide_2.jpg" alt="">
        <div class="container">
          <div class="row">
            <div class="col-xl-6 col-lg-12 col-md-12 col-12 col-sm-12 offset-xl-3 d-flex align-items-center text-center">
              <div class="single-slider">
                <div class="slider-content slider-animated">
                  <h3 class="animated">Micro e pequenas empresas ganham isenção em taxas para participar de licitações no Paraná </h3>
                  <div class="slider-btn btn-hover">
                    <a class="animated" href="#">LEIA MAIS</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="slider-height d-flex align-items-center bg-img">
        <img src="_TMP/slide_3.jpg" alt="">
        <div class="container">
          <div class="row">
            <div class="col-xl-6 col-lg-12 col-md-12 col-12 col-sm-12 offset-xl-3 d-flex align-items-center text-center">
              <div class="single-slider">
                <div class="slider-content slider-animated">
                  <h3 class="animated">Micro e pequenas empresas ganham isenção em taxas para participar de licitações no Paraná </h3>
                  <div class="slider-btn btn-hover">
                    <a class="animated" href="#">LEIA MAIS</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /fim SLIDESHOW -->
  <!-- SEÇÃO ÚLTIMAS NOTÍCIAS -->
  <section id="last-news">
    <div class="list-news">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
            <a href="">Pronampe deve beneficiar cerca de 4,5 milhões de pequenos negócios afetados pela crise</a>
            <a href="">Decreto estadual restringe funcionamento de empresas em Cascavel</a>
            <a href="">Linha emergencial de crédito é voltada para micro e pequenos empresários</a>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
            <a href="">Nota Oficial sobre o Decreto que restringe o funcionamento de empresas</a>
            <a href="">Presidente da AMIC participa de reunião sobre a pandemia do Novo Coronavírus</a>
            <a href="">Uso Obrigatório de Máscaras: Multas podem ser aplicadas diante de descumprimentos</a>
          </div>
        </div>
      </div>
    </div>
    <div class="grid-news">
      <div class="container">
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-md-4 col-12 col-sm-6">
            <a href="">
              <figure>
                <img src="_TMP/noticia_1.jpg" alt="" class="img-fluid">
                <figcaption>
                  Ponto de Atendimento da AMIC conquista Selo Ouro 
                  <cite>Nome do Autor - <strong>06 de julho, 2020</strong></cite>
                </figcaption>
              </figure>
            </a>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-12 col-sm-6">
            <a href="">
              <figure>
                <img src="_TMP/noticia_2.jpg" alt="" class="img-fluid">
                <figcaption>
                  Pronampe deve beneficiar cerca de 4,5 milhões de pequenos negócios afetados pela crise 
                  <cite>Nome do Autor - <strong>06 de julho, 2020</strong></cite>
                </figcaption>
              </figure>
            </a>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-12 col-sm-6">
            <a href="">
              <figure>
                <img src="_TMP/noticia_3.jpg" alt="" class="img-fluid">
                <figcaption>
                  MP dispensa exigências de empresas para facilitar acesso a crédito na pandemia 
                  <cite>Nome do Autor - <strong>06 de julho, 2020</strong></cite>
                </figcaption>
              </figure>
            </a>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-12 col-sm-6">
            <a href="">
              <figure>
                <img src="_TMP/noticia_4.jpg" alt="" class="img-fluid">
                <figcaption>
                  “Conecta AMIC”: entidade lança projeto de consultorias para micro e pequenos empresários
                  <cite>Nome do Autor - <strong>06 de julho, 2020</strong></cite>
                </figcaption>
              </figure>
            </a>
          </div>
        </div>
      </div>
    </div>
    <a href="" class="read-more">Mais Notícias</a>
  </section>
  <!-- /fim SEÇÃO ÚLTIMAS NOTÍCIAS -->
  <!-- PUBLICIDADE -->
  <section id="advertising-1">
    <div class="container">
      <div class="advertising-header">
        PUBLICIDADE
      </div>
      <div class="advertising-body">
        <a href="">
        <img src="https://picsum.photos/seed/picsum/2315/381" alt="" class="img-fluid">
        </a>
      </div>
    </div>
  </section>
  <!-- /fim PUBLICIDADE -->
  <!-- TV AMIC -->
  <section id="tv-amic">
    <div class="container">
      <h1 class="text-center">
        TV AMIC
      </h1>
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-12 col-sm-12">
          <iframe width="100%" height="335px" id="video-tv" class="embed-responsive-item" src="https://www.youtube.com/embed/QPxzu7stVJk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-12 col-sm-12">
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center active" data-url="QPxzu7stVJk">
              <div class="image-parent">
                <img src="http://i3.ytimg.com/vi/QPxzu7stVJk/hqdefault.jpg" class="img-fluid" alt="">
              </div>
              <div>
                <small>CASCAVEL / <strong>06/07/2020 às 14:02</strong></small>
                Boletim de notícias AMIC<br>
                Tendências pós-pandemia: o que você precisa saber sobre gestão
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center" data-url="5YSMtsFekwQ">
              <div class="image-parent">
                <img src="http://i3.ytimg.com/vi/5YSMtsFekwQ/hqdefault.jpg" class="img-fluid" alt="">
              </div>
              <div>
                <small>CASCAVEL / <strong>06/07/2020 às 14:02</strong></small>
                Boletim de notícias AMIC<br>
                16/06/2020
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center" data-url="ERV76OGJyIE">
              <div class="image-parent">
                <img src="http://i3.ytimg.com/vi/ERV76OGJyIE/hqdefault.jpg" class="img-fluid" alt="">
              </div>
              <div>
                <small>CASCAVEL / <strong>06/07/2020 às 14:02</strong></small>
                Boletim de notícias AMIC<br>
                12/06/2020
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center" data-url="Ds7cD2Roe-Y">
              <div class="image-parent">
                <img src="http://i3.ytimg.com/vi/Ds7cD2Roe-Y/hqdefault.jpg" class="img-fluid" alt="">
              </div>
              <div>
                <small>CASCAVEL / <strong>06/07/2020 às 14:02</strong></small>
                Boletim de notícias AMIC<br>
                10/06/2020
              </div>
            </li>
          </ul>
        </div>
      </div>
      <a href="" class="read-more">Mais Vídeos</a>
    </div>
  </section>
  <!-- /fim TV AMIC -->
  <!-- PODCAST -->
  <section id="podcast">
    <h1>PODCAST</h1>
    <div class="container">
      <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-6 col-12 col-sm-6">
          <div class="podcast-item">
            <img src="frontend/assets/img/black_logo.png" alt="" class="img-fluid">
            <div class="podcast-info">
              <small>Novembro / Dezembro 2019</small>
              <span>Elas estão vencendo</span>
              <a href="" class="read-more">LEIA AGORA</a>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-12 col-sm-6">
          <div class="podcast-item">
            <img src="frontend/assets/img/black_logo.png" alt="" class="img-fluid">
            <div class="podcast-info">
              <small>Setembro / Outubro 2019</small>
              <span>Os pequenos negócios também precisam estar na internet?</span>
              <a href="" class="read-more">LEIA AGORA</a>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-12 col-sm-6">
          <div class="podcast-item">
            <img src="frontend/assets/img/black_logo.png" alt="" class="img-fluid">
            <div class="podcast-info">
              <small>Julho/Agosto 2019</small>
              <span>Se desprender, aprender e empreender!</span>
              <a href="" class="read-more">LEIA AGORA</a>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-12 col-sm-6">
          <div class="podcast-item">
            <img src="frontend/assets/img/black_logo.png" alt="" class="img-fluid">
            <div class="podcast-info">
              <span>Outras edições</span>
              <a href="" class="read-more">LEIA AGORA</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /fim PODCAST -->
  <!-- PUBLICIDADE -->
  <section id="advertising-2">
    <div class="container">
      <div class="advertising-header">
        PUBLICIDADE
      </div>
      <div class="advertising-body">
        <a href="">
        <img src="https://picsum.photos/seed/picsum/2315/381" alt="" class="img-fluid">
        </a>
      </div>
    </div>
  </section>
  <!-- /fim PUBLICIDADE -->
  <!-- PARCEIROS -->
  <section id="partners">
    <div class="container">
      <div class="partners-content">
        <h1>Parceiros</h1>
        <div class="partners-area">
          <div class="partners-active owl-carousel">
            <div class="single-partner">
              <a href="#"><img src="_TMP/parceiro_1.png" alt=""></a>
            </div>
            <div class="single-partner">
              <a href="#"><img src="_TMP/parceiro_2.png" alt=""></a>
            </div>
            <div class="single-partner">
              <a href="#"><img src="_TMP/parceiro_3.png" alt=""></a>
            </div>
            <div class="single-partner">
              <a href="#"><img src="_TMP/parceiro_4.png" alt=""></a>
            </div>
            <div class="single-partner">
              <a href="#"><img src="_TMP/parceiro_5.png" alt=""></a>
            </div>
            <div class="single-partner">
              <a href="#"><img src="_TMP/parceiro_6.png" alt=""></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /fim PARCEIROS -->
  <!-- EVENTOS -->
  <section id="events">
    <div class="container">
      <div class="latest-event">
        <h1>PRÓXIMO EVENTO</h1>
        <div class="col-xl-10 col-lg-12 col-md-12 col-12 col-sm-12 offset-xl-1 d-flex align-items-center text-center">
          <div class="timer">
            <div data-countdown="2021/01/01"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="list-events">
      <div class="container">
        <h1>AGENDA DE <strong>EVENTOS</strong></h1>
        <div class="col-xl-10 col-lg-12 col-md-12 col-12 col-sm-12 offset-xl-1 d-flex align-items-center text-center">
          <div class="event-list">
            <div class="row">
              <div class="col-xl-3 col-lg-3 col-md-6 col-12 col-sm-6">
                <div class="event-info">
                  <a href="">
                    <h2><strong>08</strong> FEV</h2>
                    <h3>CASCAVEL</h3>
                    <span>EVENTO FEHADO PALESTRA AMIC</span>
                  </a>
                  <div class="social-links-events">
                    <a href="">
                    <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="">
                    <i class="fab fa-instagram"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-6 col-12 col-sm-6">
                <div class="event-info">
                  <a href="">
                    <h2><strong>28</strong> FEV</h2>
                    <h3>CASCAVEL</h3>
                    <span>EVENTO FEHADO PALESTRA AMIC</span>
                  </a>
                  <div class="social-links-events">
                    <a href="">
                    <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="">
                    <i class="fab fa-instagram"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-6 col-12 col-sm-6">
                <div class="event-info">
                  <a href="">
                    <h2><strong>02</strong> MAR</h2>
                    <h3>CASCAVEL</h3>
                    <span>EVENTO FEHADO PALESTRA AMIC</span>
                  </a>
                  <div class="social-links-events">
                    <a href="">
                    <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="">
                    <i class="fab fa-instagram"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-6 col-12 col-sm-6">
                <div class="event-info">
                  <a href="">
                    <h2><strong>16</strong> MAR</h2>
                    <h3>CASCAVEL</h3>
                    <span>EVENTO FEHADO PALESTRA AMIC</span>
                  </a>
                  <div class="social-links-events">
                    <a href="">
                    <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="">
                    <i class="fab fa-instagram"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-3 col-lg-3 col-md-6 col-12 col-sm-6">
                <div class="event-info">
                  <a href="">
                    <h2><strong>19</strong> MAR</h2>
                    <h3>CASCAVEL</h3>
                    <span>EVENTO FEHADO PALESTRA AMIC</span>
                  </a>
                  <div class="social-links-events">
                    <a href="">
                    <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="">
                    <i class="fab fa-instagram"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-6 col-12 col-sm-6">
                <div class="event-info">
                  <a href="">
                    <h2><strong>25</strong> MAR</h2>
                    <h3>CASCAVEL</h3>
                    <span>EVENTO FEHADO PALESTRA AMIC</span>
                  </a>
                  <div class="social-links-events">
                    <a href="">
                    <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="">
                    <i class="fab fa-instagram"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-6 col-12 col-sm-6">
                <div class="event-info">
                  <a href="">
                    <h2><strong>28</strong> MAR</h2>
                    <h3>CASCAVEL</h3>
                    <span>EVENTO FEHADO PALESTRA AMIC</span>
                  </a>
                  <div class="social-links-events">
                    <a href="">
                    <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="">
                    <i class="fab fa-instagram"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-6 col-12 col-sm-6">
                <div class="event-info">
                  <a href="">
                    <h2><strong>16</strong> MAR</h2>
                    <h3>CASCAVEL</h3>
                    <span>EVENTO FEHADO PALESTRA AMIC</span>
                  </a>
                  <div class="social-links-events">
                    <a href="">
                    <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="">
                    <i class="fab fa-instagram"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a href="" class="button-members">
        SEJA UM ASSOCIADO
        </a>
      </div>
    </div>
  </section>
  <!-- /fim EVENTOS -->
  <!-- MAIS LINKS -->
  <section id="more-links">
    <div class="container">
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-6 col-6 col-sm-6">
          <h3 class="link-convenio-de-saude">Convênio de Saúde</h3>
          <p>São mais de 800 médicos que podem atender você, sua família e sua equipe com um desconto atrativo em mais de 4 mil tipos de exames e parcelamento de alguns procedimentos junto ao conveniado. </p>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-6 col-sm-6">
          <h3 class="link-convenio-pet">Convênio Pet</h3>
          <p>São mais de 800 médicos que podem atender você, sua família e sua equipe com um desconto atrativo em mais de 4 mil tipos de exames e parcelamento de alguns procedimentos junto ao conveniado. </p>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-6 col-sm-6">
          <h3 class="link-plano-de-saude">Plano de Saúde</h3>
          <p>A Unimed é parceria da AMIC para a comercialização do plano de saúde. </p>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-6 col-sm-6">
          <h3 class="link-consulta-ao-credito">Consulta ao Crédito</h3>
          <p>Somos distribuidor autorizado Serasa Experian</p>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-6 col-sm-6">
          <h3 class="link-cartao-beneficios">Cartão  Benefícios</h3>
          <p>A Coopercard é parceira da AMIC na gestão de cartões de alimentação, refeição, combustível, premiação e outros.</p>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-6 col-sm-6">
          <h3 class="link-seguro-de-vida">Seguro de Vida</h3>
          <p>A Unimed Seguros é parceira da AMIC na comercialização de seguros de vida empresariais </p>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-6 col-sm-6">
          <h3 class="link-acesso-ao-credito">Acesso ao Crédito</h3>
          <p>Na AMIC você tem vantagens em operações bancárias e aquisição de linhas de crédito </p>
        </div>
      </div>
    </div>
  </section>
  <!-- /fim MAIS LINKS -->
  <!-- PUBLICIDADE -->
  <section id="advertising-3">
    <div class="container">
      <div class="advertising-header">
        PUBLICIDADE
      </div>
      <div class="advertising-body">
        <a href="">
        <img src="https://picsum.photos/seed/picsum/2315/381" alt="" class="img-fluid">
        </a>
      </div>
    </div>
  </section>
  <!-- /fim PUBLICIDADE -->
  <!-- BOTÃO MAIS NOTÍCIAS GERAL -->
  <a href="" class="full-more-news">Mais notícias</a>
  <!-- /fim BOTÃO MAIS NOTÍCIAS GERAL -->
    @include('Frontend.Layout.Includes.footer')
</div>
@endsection