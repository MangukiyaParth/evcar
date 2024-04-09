jQuery(function () {
    getnews();
});
    
function getnews(){
    var req_data = {
        op: "manage_homepage",
        action: "get_news_list"
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success == true) {
            var newsData = data.data;
            
            if(newsData && newsData.length > 0)
            {
                var html_news = "";
                newsData.forEach(function (value) {
                    html_news += `<a class="validflex2" href="${ROOT_URL}news/${value.sub_title}">
                                    <img src="${WEB_API_FOLDER+value.main_image.replace('/images/','/images_thumb/')}" class="tmp-img w-100" alt="2stcar">
                                    <h6 class="dates">${value.disp_date}</h6>
                                    <h4 class="customservice">${value.title}</h4>
                                    <p class="csrnewsub">${value.short_desc}</p>
                                    <span class="showall">Read More</span>
                                </a>`;
                    
                });
                $("#news_list").html(html_news);
                show_real_image("#news_list .tmp-img");
            }
            else{
                $(".news-area").remove();
            }
            return false;
        }
        else if (data && data != null && data.success == false) {
            return false;
        }
    });
}