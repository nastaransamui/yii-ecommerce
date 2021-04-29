
$(function(){
  const $cartQuantity = $('#cart-quantity');
  const $addToCart = $('.btn-add-to-card');
  const $itemQuantities = $('.item-quantity');
  $addToCart.click(event =>{
    event.preventDefault();
    const $this = $(event.target);
    const id =$this.closest('.product-item').data('key');
    $.ajax({
      method: 'POST',
      url: $this.attr('href'),
      data: {id},
      success: function(){
        $cartQuantity.text(parseInt($cartQuantity.text() || 0)+1)
      }
    })
  })

  $itemQuantities.change(event =>{
    const $this = $(event.target);
    let $tr = $this.closest('tr');
    const $td = $this.closest('td');
     const id = $tr.data('id');
    $.ajax({
      method: 'POST',
      url: $tr.data('url'),
      data: {id, quantity: $this.val()},
      success: function(result){
        console.log(result)
        $cartQuantity.text(result.quantity);
        $td.next().text(result.price);
        
      }
    })
  })
});
