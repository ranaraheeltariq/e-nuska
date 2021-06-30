(function($) {
  'use strict';

  //Lead Detail Modal
  $('#detailModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever')
    var lead = button.data('lead')
    var doctor = button.data('doctor')
    var remarks = button.data('remarks')
    var products = button.data('products')
    var modal = $(this)
    modal.find('.cname').show()
    modal.find('.number').show()
    modal.find('.dname').show()
    modal.find('.dnumber').show()
    modal.find('.dclinic').show()
    modal.find('.file1').show()
    modal.find('.file2').show()
    modal.find('.modal-title').text('Detail of lead Id: ' + recipient)
    lead.customer_name != null ? modal.find('#cname').text(lead.customer_name) : modal.find('.cname').hide()
    lead.customer_number != null ? modal.find('#number').text(lead.customer_number) : modal.find('.number').hide()
    doctor.doctor_name != null ? modal.find('#dname').text(doctor.doctor_name) : modal.find('.dname').hide()
    doctor.doctor_number != null ? modal.find('#dnumber').text(doctor.doctor_number) : modal.find('.dnumber').hide()
    doctor.doctor_clinic != null ? modal.find('#dclinic').text(doctor.doctor_clinic) : modal.find('.dclinic').hide()
    lead.file1 != null ? modal.find('#file1').html('<a href="/images/prescription/'+lead.file1+'" target="_blank"><img width=100px height=100px src="/images/prescription/'+lead.file1+'" /></a>') : modal.find('.file1').hide()
    lead.file2 != null ? modal.find('#file2').html('<a href="/images/prescription/'+lead.file2+'" target="_blank"><img width=100px height=100px src="/images/prescription/'+lead.file2+'" /></a>') : modal.find('.file2').hide()
    $('.products').html('')
    $.each(products, function(key1, value){
      // console.log('Key => '+key1+', Value => '+value.medicine_name)
      $('.products').prepend('<p class="clearfix product"><span class="float-left">'+value.medicine_name+'</span><span class="float-right text-muted">'+value.quantity+'</span></p>');
    });
    var i = 1;
     $('.remarks').html('')
      $.each(remarks, function(key1, value){
      $('.remarks').prepend('<p class="clearfix remark"><span class="float-left"><a href="/profile/users/'+value.user_id+'" target="_blank"> User ID '+ value.user_id +'</a> </span><span>&nbsp;('+ formatDate(value.created_at)+')</span><span class="float-right text-muted">'+value.description+'</span></p>');
       i += 1;
      });

  })

  //Order Detail Modal
  $('#orderdetailModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever')
    var lead = button.data('lead')
    var doctor = button.data('doctor')
    var order = button.data('order')
    var products = button.data('products')
    var modal = $(this)
    modal.find('.cname').show()
    modal.find('.number').show()
    modal.find('.address').show()
    modal.find('.dname').show()
    modal.find('.dnumber').show()
    modal.find('.dclinic').show()
    modal.find('.invwod').show()
    modal.find('.invwd').show()
    modal.find('.file1').show()
    modal.find('.modal-title').text('Detail of Order Id: ' + recipient)
    order.customer_name != null ? modal.find('#cname').text(order.customer_name) : modal.find('.cname').hide()
    order.customer_number != null ? modal.find('#number').text(order.customer_number) : modal.find('.number').hide()
    order.customer_address != null ? modal.find('#address').text(order.customer_address) : modal.find('.address').hide()
    doctor.doctor_name != null ? modal.find('#dname').text(doctor.doctor_name) : modal.find('.dname').hide()
    doctor.doctor_number != null ? modal.find('#dnumber').text(doctor.doctor_number) : modal.find('.dnumber').hide()
    doctor.doctor_clinic != null ? modal.find('#dclinic').text(doctor.doctor_clinic) : modal.find('.dclinic').hide()
    order.invoice_without_discount != null ? modal.find('#invwod').text(order.invoice_without_discount) : modal.find('.invwod').hide()
    order.invoice_with_discount != null ? modal.find('#invwd').text(order.invoice_with_discount) : modal.find('.invwd').hide()
    order.invoice_file != null ? modal.find('#file1').html('<a href="/images/invoice/'+order.invoice_file+'" target="_blank">Open Invoice</a>') : modal.find('.file1').hide()
    $('.products').html('')
    $.each(products, function(key1, value){
      // console.log('Key => '+key1+', Value => '+value.medicine_name)
      $('.products').prepend('<p class="clearfix product"><span class="float-left">'+value.medicine_name+'</span><span class="float-right text-muted">'+value.quantity+'</span></p>');
    });

  })


  // Customer Not Interested Modal
  $('#notinterested').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever')
    var link = button.data('link')
    var modal = $(this)
    modal.find('.modal-title').text('Customer Not Interested of lead Id: ' + recipient)
    modal.find('.modal-body form').attr('action',link)
  })

   // Customer Remarks Modal
  $('#remarks').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever')
    var link = button.data('link')
    var modal = $(this)
    modal.find('.modal-title').text('Customer Remarks of lead Id: ' + recipient)
    modal.find('.modal-body form').attr('action',link)
    modal.find('#lead_id').attr('value',recipient)
  })

  // Assign Rider Modal
  $('#rider').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever')
    var link = button.data('link')
    var modal = $(this)
    modal.find('.modal-title').text('Assign Rider to Order No: ' + recipient)
    modal.find('.modal-body form').attr('action',link)
  })

  // Assign Agent Modal
  $('#agent').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever')
    var link = button.data('link')
    var user = button.data('user')
    var modal = $(this)
    modal.find('.modal-title').text('Assign Call Center Agent to Lead No: ' + recipient)
    modal.find('.modal-body form').attr('action',link)
    $('#user_id option[value="'+user+'"]').attr("selected", "selected");
  })

  // Upload Invoice Modal
  $('#uploadinvoice').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever')
    var link = button.data('link')
    var modal = $(this)
    modal.find('.modal-title').text('Upload Invoice to Order No: ' + recipient)
    modal.find('.modal-body form').attr('action',link)
  })
  function formatDate(date) {
     var d = new Date(date),
         month = '' + (d.getMonth() + 1),
         day = '' + d.getDate(),
         year = d.getFullYear();
         var hours = d.getHours();
         var mint = d.getMinutes();
         var sec = d.getSeconds();
         

     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;
     var da = [year, month, day].join('-');
     var ta = [hours,mint,sec].join(':');
     return [da,ta].join(' ');
  }

})(jQuery);