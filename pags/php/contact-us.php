<?php include('components/header-component.php'); ?>

<div id="contact-page" class="container">
    <div class="bg">
        <!-- <div class="row">    		
            <div class="col-sm-12">    			   			
                <h2 class="title text-center">Contact <strong>Us</strong></h2>    			    				    				
                <div id="gmap" class="contact-map">
                </div>
            </div>			 		
        </div> -->
        <div class="row">  	
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">Entre em Contato</h2>
                    <div class="status alert alert-success" style="display: none"></div>
                    <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                        <div class="form-group col-md-6">
                            <input type="text" name="nome" class="form-control" required="required" placeholder="Nome">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" name="email" class="form-control" required="required" placeholder="Email">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="assunto" class="form-control" required="required" placeholder="Assunto">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="mensagem" id="message" required="required" class="form-control" rows="8" placeholder="Descreva sua mensagem aqui..."></textarea>
                        </div>                        
                        <div class="form-group col-md-12">
                            <input type="submit" name="enviarMensagem" class="btn btn-primary pull-right" value="Enviar">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">Nosso contato</h2>
                    <address>
                        <p><?php echo titulo; ?> Inc.</p>
                        <!-- <p>935 W. Webster Ave New Streets Chicago, IL 60614, <?php echo contato_local_estado; ?></p> -->
                        <p><?php echo contato_local_estado ." - ". contato_local_pais ?></p>
                        <p>Telefone: <?php echo contato_telefone; ?></p>
                        <!-- <p>Fax: 1-714-252-0026</p> -->
                        <p>Email: <?php echo contato_email; ?></p>
                    </address>
                    <div class="social-networks">
                        <h2 class="title text-center">Acompanhe-nos</h2>
                        <ul>
                            <li><a href="<?php echo contato_facebook; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
                            <li><a href="<?php echo contato_instagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li> 
                            <li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>    			
        </div>  
    </div>	
</div><!--/#contact-page-->

<?php include('components/footer-component.php'); ?>