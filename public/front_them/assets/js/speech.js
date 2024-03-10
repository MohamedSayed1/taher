// let allVoices, allLanguages, primaryLanguages, langtags, langhash, langcodehash;
// let txtFld, rateFld, speakBtn, speakerMenu, languageMenu, blurbs;
// let voiceIndex = 0;
// let initialSetup = true;
// let defaultBlurb = "I enjoy the traditional music of my native country.";

// function init(){
//   speakBtn = qs("#speakBtn");
//   txtFld = qs("#txtFld"); 
//   speakerMenu = qs("#speakerMenu");
//   langtags = getLanguageTags();
//   speakBtn.addEventListener("click",talk,false);
//   speakerMenu.addEventListener("change",selectSpeaker,false);

//   createBlurbs();
//   rateFld = qs("#rateFld");
//   languageMenu = qs("#languageMenu"); 
//   languageMenu.addEventListener("change",selectLanguage,false);
//   langhash = getLookupTable(langtags,"name");
//   langcodehash = getLookupTable(langtags,"code");

//   if (window.speechSynthesis) {
//     if (speechSynthesis.onvoiceschanged !== undefined) {
//       //Chrome gets the voices asynchronously so this is needed
//       speechSynthesis.onvoiceschanged = setUpVoices;
//     }
//     setUpVoices(); //for all the other browsers
//   }else{
//     speakBtn.disabled = true;
//     speakerMenu.disabled = true;
//     languageMenu.disabled = true;
//     qs("#warning").style.display = "block";
//   }
// }
// function setUpVoices(){
//   allVoices = getAllVoices();
//   allLanguages = getAllLanguages(allVoices);
//   primaryLanguages = getPrimaryLanguages(allLanguages);
//   filterVoices();
//   if (initialSetup && allVoices.length){
//     initialSetup = false;
//     createLanguageMenu();
//   }
// }
// function talk(){
//   let sval = Number(speakerMenu.value);
//   let u = new SpeechSynthesisUtterance();
//   u.voice = allVoices[sval];
//   u.lang = u.voice.lang;
//   u.text = txtFld.value;
//   u.rate = Number(rateFld.value);
//   speechSynthesis.speak(u);
// }
// function createLanguageMenu(){
//   let code = `<option selected value="all">Show All</option>`;
//   let langnames = [];
//   primaryLanguages.forEach(function(lobj,i){
//     langnames.push(langcodehash[lobj.substring(0,2)].name);
//   });
//   langnames.sort();
//   langnames.forEach(function(lname,i){
//     let lcode = langhash[lname].code;
//     code += `<option value=${lcode}>${lname}</option>`;
//   });
//   languageMenu.innerHTML = code;
// }
// function createSpeakerMenu(voices){
//   let code = ``;
//   voices.forEach(function(vobj,i){
//     code += `<option value=${vobj.id}>${vobj.name} (${vobj.lang})`;
//     code += vobj.voiceURI.includes(".premium") ? ' (premium)' : ``;
//     code += `</option>`;
//   });
//   speakerMenu.innerHTML = code;
// }
// function getAllLanguages(voices){
//   let langs = [];
//   voices.forEach(vobj => {
//     langs.push(vobj.lang.trim());
//   });
//   return [...new Set(langs)];
// }
// function  getPrimaryLanguages(langlist){
//   let langs = [];
//   langlist.forEach(vobj => {
//     langs.push(vobj.substring(0,2));
//   });
//   return [...new Set(langs)];
// }
// function selectSpeaker(){
//   voiceIndex = speakerMenu.selectedIndex;
// }
// function selectLanguage(){
//   filterVoices();
//   speakerMenu.selectedIndex = 0;
// }
// function filterVoices(){
//   let langcode = languageMenu.value;
//   voices = allVoices.filter(function (voice) {
//     return langcode === "all" ? true : voice.lang.indexOf(langcode + "-") >= 0;
//   });
//   createSpeakerMenu(voices);
//   let t = blurbs[languageMenu.options[languageMenu.selectedIndex].text];
//   txtFld.value = t ? t : defaultBlurb;
//   speakerMenu.selectedIndex = voiceIndex;
// }


// function getAllVoices() {
//   let voicesall = speechSynthesis.getVoices();
//   let vuris = [];
//   let voices = [];
//   //unfortunately we have to check for duplicates
//   voicesall.forEach(function(obj,index){
//     let uri = obj.voiceURI;
//     if (!vuris.includes(uri)){
//         vuris.push(uri);
//         voices.push(obj);
//      }
//   });
//   voices.forEach(function(obj,index){obj.id = index;});
//   return voices;
// }
// function createBlurbs(){
//   blurbs = {
//     "Arabic" : "أنا أستمتع بالموسيقى التقليدية لبلدي الأم.",
//     "Dutch" : "Ik geniet van de traditionele muziek van mijn geboorteland.",
//     "English" : "I enjoy the traditional music of my native country.",
//   };
// }

// function getLanguageTags(){
//   let langs = ["ar-Arabic", "en-English","nl-Dutch"];
//   let langobjects = [];
//   for (let i=0;i<langs.length;i++){
//     let langparts = langs[i].split("-");
//     langobjects.push({"code":langparts[0],"name":langparts[1]});
//   }
//   return langobjects;
// }
// // Generic Utility Functions
// function qs(selectorText){
//   //saves lots of typing for those who eschew Jquery
//   return document.querySelector(selectorText);
// }
// function getLookupTable(objectsArray,propname){
//   return objectsArray.reduce((accumulator, currentValue) => (accumulator[currentValue[propname]] = currentValue, accumulator),{});
// }
// document.addEventListener('DOMContentLoaded', function (e) {
//   try {init();} catch (error){
//     console.log("Data didn't load", error);}
// });

let allVoices;
let questionText = $('.question-text').text();
let answers = $('.question-answer').map((index, answer) => {
    return answer.innerText;
})
console.log(answers)


function setSpeech() {
    return new Promise(
        function (resolve, reject) {
            let synth = window.speechSynthesis;
            let id;

            id = setInterval(() => {
                if (synth.getVoices().length !== 0) {
                    resolve(synth.getVoices());
                    clearInterval(id);
                }
            }, 10);
        }
    )
}

let s = setSpeech();
s.then((voices) => {
    allVoices = voices.filter((voice) => ['ar-EG', 'nl-NL'].includes(voice.lang));
    console.log(allVoices)
    speak();
});    // Or any other actions you want to take...

let u = new SpeechSynthesisUtterance();
function speak() {
    u.voice = allVoices[0];
    u.lang = u.voice.lang;
    u.text = questionText;
    speechSynthesis.speak(u);
    answers.map((index, answer) => {
        u.text = answer;
        speechSynthesis.speak(u);    
    });
}

$('.test-btn').on('click', function () {
    speak();
});

$('#sound-btn').on('click', function () {
    let val = $('#sound-btn').prop('checked');
    console.log(val);
    if(val) {
        speechSynthesis.speak(u);
    } else {
        speechSynthesis.cancel();
    }
});

$('#speak-btn').on('click', function () {
    let val = $('#speak-btn').prop('checked');
    console.log(val);
    if(val) {
        speechSynthesis.speak(u);
    } else {
        speechSynthesis.cancel();
    }
});
