
function succ(){
  return new swal({
  title: "Success!",
  text: "Attendance has been Taken!",
  icon: "success",
  // button: "Aww yiss!",
});
};

function conf(){
  
  return new swal({
    title: 'Are you sure?',
    text: "It will permanently deleted !",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then(function() {
    swal(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    );
  })
};

function error1(){
  return swal({
  icon: 'error',
  title: 'Oops...',
  text: 'Something went wrong!',
  footer: '<a href="">Why do I have this issue?</a>'
})
}