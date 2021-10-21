<template>
  <div class="flex justify-center mt-3" style="width: 60%;margin-left:20%">
      <div class="mx-5 d-flex justify-content-space" style="height: 250px; background-color:rgb(192, 194, 223);">
        
        <div class="ps-3 " >
              <h4> {{nom}} </h4> 
              <div class="mt-3"><strong>tel</strong> </div>
              <div class="mt-3"><strong>email</strong> </div>
          </div>
      </div>
   </div>
</template>

<script>
export default {
    data(){
        return {
            nom : "nnn"
        }
    },
    mounted (){
        console.log("lkd")
        
    }
}
</script>

<style>

</style>