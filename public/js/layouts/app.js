      
        function update_logged_in()
        {
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.open("GET","/profile/update/update_online_info");
            xmlhttp.send();
            // console.log("done");
        }


        function doFirst()
        {
            update_logged_in();
            // console.log("hello");
           doFirstTimeout= setTimeout(doFirst,30000);
        }

        function check_blank_string(search_input)
        {
            var len=search_input.length;
            var spaces=0;
            for(var i=0;i<len;i++)
            {
                if(search_input[i]==' ')
                {
                    spaces++;
                }
            }
            // console.log(spaces+" "+len);
            if(spaces==len)
            return true;

            return false;
        }

        function search(search_input)
        {
            var xmlhttp=new XMLHttpRequest();
            // console.log(check_blank_string(search_input));
            if(!check_blank_string(search_input))
            {
            xmlhttp.open("GET","/topics/search/"+search_input);

            xmlhttp.onreadystatechange=function()
            {
                if(xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    // console.log(xmlhttp.responseText);
                    if(xmlhttp.responseText.length>0)
                    document.getElementById('search_results').innerHTML=xmlhttp.responseText;

                    else 
                    {
                        document.getElementById('search_results').innerHTML="<br><a><li> No such topic or username exists</li></a><br>";
                    }
                }
            }
            xmlhttp.send();
            }

            else
            {
               document.getElementById('search_results').innerHTML="<br><a><li> No such topic or username exists</li></a><br>";

            }
           
        }
        
        window.addEventListener('load',doFirst);