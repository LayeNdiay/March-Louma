class LightboxStore{
    constructor(){
        this.state = {
            image :[],
            index : false
        }
    }
    addImage(url)
    {
       return this.state.image.push(url)
    }
    open(index)
    {
        this.state.index = index
    }
    close()
    {
        this.state.index = false
    }
    next()
    {
        this.state.index++
        if (this.state.index > this.state.image.length) {
            this.state.index = 1
        }
        
    }
    prev()
    {
        this.state.index--
        if (this.state.index < 1 ) {
            this.state.index = this.state.image.length
        }
        
    }
}
export default new LightboxStore()