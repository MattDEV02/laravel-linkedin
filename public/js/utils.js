const isValid = val => val !== null && val !== undefined && val !== false;

const sound = () => new Audio('/sound/success.mp3').play();