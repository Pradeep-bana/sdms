<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    
// window.addEventListener('load',function (){
//  Swal.fire({
//   icon: 'error',
//   title: 'Oops...',
//   text: 'Something went wrong!',
//   footer: '<a href="">Why do I have this issue?</a>'
// });
// });

function run(){
  Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Something went wrong!',
  footer: '<a href="">Why do I have this issue?</a>'
});
};
</script>
<button onclick='run()' value='submit'></button>