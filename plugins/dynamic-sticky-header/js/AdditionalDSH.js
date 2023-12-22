addEventListener('load', () => {  
    //var adsthClassName;
    async function loadNames() {
        //deliver additional classname from backend
        const url = '/wp-json/additionalsettings/v1/settings'
        const response = await fetch(url);
        const names = await response.json();
        //pickup the new value
        var adsthClassName = await JSON.stringify(names[0].Additional_Header_Value).split("\"")[1];
        //alert(adsthClassName);
        
        
        
     //now to business...
    
     function createClass(name,rules){
        
        let style = document.createElement('style');
        style.type = 'text/css';
        document.getElementsByTagName('head')[0].appendChild(style);
        if(!(style.sheet||{}).insertRule){
            (style.styleSheet || style.sheet).addRule(name, rules);
          }
        else{
            style.sheet.insertRule(name+"{"+rules+"}",0);
          }
    }
    createClass('header',"transition: top 0.2s ease-in-out;");
    
    var headerTop = document.getElementsByClassName(adsthClassName)[0]
    const style = getComputedStyle(headerTop);
    
    //set inital screen view that is on top so it is "0"
    var isScrolledDown = 0;
  
    //Transform css values to real numbers and set new css values dynamically
    //Hide header by setting its height to minus "itself"
    const orginalHeaderHeightNumber = parseInt(style.height.replace('px', ''), 10);
    const hideHeader = orginalHeaderHeightNumber - (orginalHeaderHeightNumber * 2);
    
    console.log("hoho");
    if(document.getElementsByClassName(adsthClassName).length >= 1){
    
    window.addEventListener("scroll", function() {
    
      var scrollTop = document.documentElement.scrollTop;
    
    
      if (scrollTop > isScrolledDown) {
        headerTop.style.top = `${hideHeader.toString()}px`;
      }
    
      else {
        headerTop.style.top = "0px";
      }
      isScrolledDown = scrollTop;
    })
    } else {
      console.log("DOM doesn't have a header element!")
    }
    
    
      }
      loadNames();
    })
     
     