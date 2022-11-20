const alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
const numAlph = {}

for(let i = 0; i < alphabet.length; i++){
  numAlph[alphabet[i]] = i
}

function Encode(text, key){
  let code = ''

  for(let i = 0; i < text.length; i++){
    code += alphabet[(numAlph[text[i]] + numAlph[key[i % key.length]]) % alphabet.length]
  }
  return code
}

function Decode(text, key){
  let code = ''

  for(let i = 0; i < text.length; i++){
    code += alphabet[(numAlph[text[i]] - numAlph[key[i % key.length]] + alphabet.length) % alphabet.length]
  }
  return code
}

console.log("encoded word: ", Encode("STUDENT", "EXAM"))
console.log("decoded word: ", Decode("WQUPIKT", "EXAM"))