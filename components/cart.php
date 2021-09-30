<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info" style="border: none;">
<?php
  $produtos = new produtos($explode['1']);
  $produtos ->produtos_vefica_login();
?>
<form method="POST">
    <div class="r-description">
        Revise antes de continuar
    </div>

    <div class="table-responsive">
        <table class="table">
            <tr>
                <th id="remove">Produto</th>
                <th id="remove" width="20%">Quantidade</th>
                <th id="remove">Preço</th>
            </tr>
            <?php $produtos->produtos_verificaEstoque();?>
            <tr>
                <td><?php echo $produtos->nome;?></td>
                <td align="center"><input type="number" id="quantity" min="1" max="<?php $produtos->produtos_getMax();?>" class="col-sm-7" value="1"></td>
            <input type="hidden" id="valor_produto" value="<?php echo $produtos->preco;?>">
                <td>R$ <?php echo $produtos->preco;?></td>
            </tr>
        </table>
    </div>
    <div class="float-right">
        <div class="form-inline">
        <label class="my-1 mr-2">Subtotal:</label> 
        <input type="text" name="subtotal" readonly class="custom-select my-1 mr-sm-2" id="subtotal" style="border: none;">
    </div>

    <br>
    <label>Informações Adicionais</label>
    <textarea class="form-control" name="detalhes" rows="4" placeholder="Especifique algo"></textarea>
    <br>

    <p align="right"><input type="submit" value="Finalizar e pagar" class="btn btn-outline-success"></p>
    <input type="hidden" name="nome_produto" value="<?php echo $produtos->nome;?>">
    <input type="hidden" name="env" value="compra">
</form>
                <?php $produtos->produtos_finalizar_compra($explode['1']); ?> 
            </div>

        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>O que gostaria de fazer a seguir?</h3>
            <p>Selecione se voce possui um desconto ou quer estimar seu custo de entrega.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Cupons</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use cartões de presente</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Métodos de entrega</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>País:</label>
                            <select>
                                <option>Brasil</option>
                                <!-- <option>Estados Unidos</option>
                                <option>Reino Unido</option>
                                <option>India</option>
                                <option>Paquistão</option>
                                <option>Ucrania</option>
                                <option>Canada</option>
                                <option>Dubai</option> -->
                            </select>
                            
                        </li>
                        <li class="single_field">
                            <label>Região / Estado:</label>
                            <select>
                                <option>Selecionar</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                        
                        </li>
                        <li class="single_field zip-field">
                            <label>CEP:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default check_out" href="">Continuar</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
