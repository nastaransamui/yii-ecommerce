
$(function(){
  const cartQuantity = $('#cart-quantity');
  const addToCart = $('.btn-add-to-card');
  addToCart.click(event =>{
    event.preventDefault();
    const $this = $(event.target);
    const id =$this.closest('.product-item').data('key');
    $.ajax({
      method: 'POST',
      url: $this.attr('href'),
      data: {id},
      success: function(){
        cartQuantity.text(parseInt(cartQuantity.text() || 0)+1)
      }
    })
  })
});
