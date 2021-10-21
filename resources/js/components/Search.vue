<template>
    <div  id="searchParent" @click.stop="open" >
        <!-- <form action="" method="POST">
            <input type="hidden" name="_token" value="Of6qarAHazcDcnKQF3klltsE88JiaI8LAcpAbFLi"> <input autocomplete="off" type="search" placeholder="rechercher un produit" id="search1">
             <label for="search" class="fas fa-search"></label>
            </form> <div id="searchResult" hidden="hidden" class="bg-light"></div>
         -->

	</div>
</template>
<script>
export default {
    data(){
        return{
            q :"",
            articles : [],
        }
    },
    methods:{
        open(){
            var result = document.querySelector("#searchResult");
            if (result.getAttribute("hidden")  ) 
            {
                result.removeAttribute("hidden")
            }
        },
        fetchArticles()
        {
            axios.get("/api/allArticles")
            .then(response => {
                this.articles = response.data
            })
            .catch(error =>{
                console.log(error);
            })
        },
        redirect(article)
        {
            window.location.href= '/article/' + article
        },
        action()
        {
            
                return '/search/' + this.q
        },
        submit(e)
        {
          
            document.querySelector("form").submit()
        }
    },
    computed : {
        getArticles()
        {
            if(this.q !== "")
            {
                document.querySelector("form").action = "/search/"+this.q
                return this.articles.filter(article =>{
                    return article.nomArticle.toLowerCase().includes(this.q.toLowerCase())
                })
            }
            else
            {
                document.querySelector("form").action = ""
            }
        }
    },
    mounted()
    {
        this.fetchArticles()
    },
    


}
let header = document.querySelector("body");

header.addEventListener("click",function (e) {
var result = document.querySelector("#searchResult");
      if (result !== null) {
          if (result.getAttribute("hidden") === null ) {
                 result.setAttribute('hidden',true)
          }
      }
    })





    
 


</script>
<style>
    #searchParent{
        z-index: 10;
    }
    #searchResult
    {
        background-color: white;
        height: auto;
        position: absolute;
        z-index:1;
        width: 300px;
    }

</style>