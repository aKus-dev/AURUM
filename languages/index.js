localStorage.setItem('lang', 'en');

const lang = localStorage.getItem('lang');

lang === 'en' && setEnglish();

// Navs
const home = document.querySelector('#home');
const about = document.querySelector('#about');
const provide = document.querySelector('#provide');
const contact = document.querySelector('#contact');

const home2 = document.querySelector('#home2');
const about2 = document.querySelector('#about2');
const provide2 = document.querySelector('#provide2');
const contact2 = document.querySelector('#contact2');

// Resto
const titleText = document.querySelector('#title');
const descText = document.querySelector('#desc');
const btnLoginText = document.querySelector('#btn-login');
const btnSignupText = document.querySelector('#btn-signup');
const featuresText = document.querySelector('#features');
const featuresTitleText = document.querySelector('#featuresTitle');

// Articles
const article1Text = document.querySelector('#article1');
const article1ContentText = document.querySelector('#article1-content');
const article2Text = document.querySelector('#article2');
const article2ContentText = document.querySelector('#article2-content');
const article3Text = document.querySelector('#article3');
const article3ContentText = document.querySelector('#article3-content');

// One step
const oneStepText = document.querySelector('#one-step');
const oneStepContentText = document.querySelector('#one-step-content');
const oneStepBtnText = document.querySelector('#one-step-btn');

// Opinion
const review1Text = document.querySelector('#review1');
const review1InfoText = document.querySelector('#review1-info');
const review2Text = document.querySelector('#review2');
const review2InfoText = document.querySelector('#review2-info');
const review3Text = document.querySelector('#review3');
const review3InfoText = document.querySelector('#review3-info');

// Slider
const weProvideTitleText = document.querySelector('#we-provide');
const weProvide1Text = document.querySelector('#we-provide1');
const weProvide1ContentText = document.querySelector('#we-provide1-content');
const weProvide2Text = document.querySelector('#we-provide2');
const weProvide2ContentText = document.querySelector('#we-provide2-content');
const weProvide3Text = document.querySelector('#we-provide3');
const weProvide3ContentText = document.querySelector('#we-provide3-content');

// Us
const usText = document.querySelector('#us-title');
const usDescText = document.querySelector('#us-desc');

// Contact
const contactTextSelect = document.querySelector('#contact-title');
const inputName = document.querySelector('input[name="name"]');
const inputLastName = document.querySelector('input[name="lastname"]');
const inputMail = document.querySelector('input[name="email"]');
const inputMsg = document.querySelector('textarea');
const btnSend = document.querySelector('#btn-send')

async function setEnglish() {
    const res = await fetch('/languages/index.json');
    const data = await res.json();

    const {
        nav,
        title,
        desc,
        btnLogin,
        btnSignup,
        features,
        featuresTitle,
        article1,
        article1Content,
        article2,
        article2Content,
        article3,
        article3Content,
        oneStep,
        oneStepContent,
        oneStepBtn,
        review1,
        review1Info,
        review2,
        review2Info,
        review3,
        review3Info,
        weProvideTitle,
        weProvide1,
        weProvide1Content,
        weProvide2,
        weProvide2Content,
        weProvide3,
        weProvide3Content,
        us,
        usDesc,
        contact,
        name,
        lastName,
        email,
        message,
        send
    } = data;

    const [homeText, aboutText, provideText, contactText] = nav;

    // Navs
    home.textContent = homeText;
    about.textContent = aboutText;
    provide.textContent = provideText;
    contact.textContent = contactText;

    home2.textContent = homeText;
    about2.textContent = aboutText;
    provide2.textContent = provideText;
    contact2.textContent = contactText;

    titleText.textContent = title;
    descText.textContent = desc;
    btnLoginText.textContent = btnLogin;
    btnSignupText.textContent = btnSignup;
    featuresText.textContent = features;
    featuresTitleText.textContent = featuresTitle;

    // Articles
    article1Text.textContent = article1;
    article1ContentText.textContent = article1Content;
    article2Text.textContent = article2;
    article2ContentText.textContent = article2Content;
    article3Text.textContent = article3;
    article3ContentText.textContent = article3Content;

    // One step
    oneStepText.textContent = oneStep;
    oneStepContentText.textContent = oneStepContent;
    oneStepBtnText.textContent = oneStepBtn;

    // Review
    review1Text.textContent = review1;
    review1InfoText.textContent = review1Info;
    review2Text.textContent = review2;
    review2InfoText.textContent = review2Info;
    review3Text.textContent = review3;
    review3InfoText.textContent = review3Info;

    // Slider
    weProvide1Text.textContent = weProvide1;
    weProvide1ContentText.textContent = weProvide1Content;
    weProvide2Text.textContent = weProvide2;
    weProvide2ContentText.textContent = weProvide2Content;
    weProvide3Text.textContent = weProvide3;
    weProvide3ContentText.textContent = weProvide3Content;
    weProvideTitleText.textContent = weProvideTitle;

    // Us
    usText.textContent = us;
    usDescText.textContent = usDesc;

    // Contact
    contactTextSelect.textContent = contact;
    inputName.placeholder = name;
    inputLastName.placeholder = lastName;
    inputMail.placeholder = email;
    inputMsg.placeholder = message;
    btnSend.textContent = send;
   
}


