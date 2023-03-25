import '../app'
const relationId=document.querySelector("#relationId").value;


const channel = Echo.channel(`App.LiveRelation.${relationId}`);
const relationContainer =document.querySelector("#relationContainer");
const body = document.body;
const html = document.documentElement;
var data={};

/**
 *
 * @param url
 */
const makeRequest=(url=`/live/relation/${relationId}`)=>{

    axios.get(url).then((res)=>{
        data=res.data.data;
        console.log(data);
        data.map((element)=>{
            relationContainer.prepend(
                MessageContainer(element.relationTitle,
                    element.title,
                    element.content,
                    element.date
                )
            );
        })
    });
}
/**
 *
 * @param relationTitle
 * @param title
 * @param content
 * @param date
 * @returns {HTMLDivElement}
 * @constructor
 */
const MessageContainer=(relationTitle,title,content,date)=>{
    let element = document.createElement("div");
    element.innerHTML =`
        <div class="card my-4" style="width: 40rem;">
          <div class="card-body">
            <h5 class="card-title">${title}</h5>
            <h6 class="card-subtitle mb-2 text-muted">${relationTitle}</h6>
            <p class="card-text">${content}</p>
          </div>
           <div class="card-footer text-muted">
            ${date}
           </div>
        </div>
    `;
    return element;
}

makeRequest();

/**
 *
 */
channel.subscribed(()=>{
    console.log('connected');
}).listen(`.LiveRelation_${relationId}`,(element)=>{

    relationContainer.prepend(
        MessageContainer(element.relationTitle,
            element.title,
            element.content,
            element.date
            )
    );
});





