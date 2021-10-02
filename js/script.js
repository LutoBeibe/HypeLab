$(document).ready(function() {

	jQuery("#telefone")
        .mask("(99) 99999-9999")
        .focusout(function (event) {  
            var target, phone, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
            phone = target.value.replace(/\D/g, '');
            element = $(target);  
            element.unmask();  
        });

    jQuery("#cep")
        .mask("99999-999")
        .focusout(function (event) {  
            var target, cep, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
            cep = target.value.replace(/\D/g, '');
            element = $(target);  
            element.unmask();
        });

    jQuery("#cpf")
        .mask("999.999.999-99")
        .focusout(function (event) {  
            var target, cpf, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
            cpf = target.value.replace(/\D/g, '');
            element = $(target);  
            element.unmask();
        });

	$("#subtotal").val($("#valor_produto").val());
	$("#quantity").change(function(){
		var preco = $("#valor_produto").val();
		var quantity = $("#quantity").val();
		var newpreco = preco*quantity;
	  //$("#subtotal").val(newpreco);
	  calcula();
	});

	function calcula(){
        var quant = document.getElementById("quantity").value;
        var unidade = document.getElementById("valor_produto").value;

        if((quant == "" || quant == null) && (unidade == "" || unidade == null))
            return false;

        while(quant.indexOf(',') != -1)
            quant = quant.replace(',','.');

        while(unidade.indexOf(',') != -1)
            unidade = unidade.replace(',','.');

        var total = parseFloat(quant*unidade);   
        document.getElementById("subtotal").value = total;   
	}

});