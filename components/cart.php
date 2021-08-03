<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
<?php
  $produtos = new produtos($explode['1']);
  $produtos ->produtos_vefica_login();
?>
<form method="POST">
    <div class="r-description">
        Revise antes de continuar
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                
                <th>Produto</th>
                <th width="20%">Quantidade</th>
                <th>Preço</th>
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
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                            
                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                        
                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>$59</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>$61</span></li>
                    </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
