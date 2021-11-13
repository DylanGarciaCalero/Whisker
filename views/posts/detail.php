<script>

fetch('/api/get_posts')
.then(response => response.json())
.then(data => {
  console.log(data[0].user_id);
})
.catch((error) => {
  console.log(error);
});
</script>