import '../app'
const relationId=document.querySelector("#relationId").value;


const channel = Echo.channel(`App.LiveRelation.${relationId}`);
const relationContainer =document.querySelector("#relationContainer");


/*
    todo
 *   axios call to get all prev messages
 *   ws connection to get new messages
 *   some counters
 *   newsletter
 */

const MessageContainer=(relationTitle,title,content,image)=>{
    let element = document.createElement("div");
    element.innerHTML =`
        <div class="card my-4" style="width: 40rem;">
          <div class="card-body">
            <h5 class="card-title">${title}</h5>
            <h6 class="card-subtitle mb-2 text-muted">${relationTitle}</h6>
            <p class="card-text">${content}</p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
          </div>
        </div>
    `;
    return element;
}

for(let i=0;i<5;i++){
    relationContainer.prepend(
        MessageContainer('test1',
            `test_${i}`,
            'elooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo')
    );

}




channel.subscribed(()=>{
   console.log('connected');
}).listen(`.LiveRelation_${relationId}`,(event)=>{
    console.log(event)
});
