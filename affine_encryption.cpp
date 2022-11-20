#include <iostream>
#include <string>
#include <cctype>

using namespace std;

string alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

int keycode(char s){
    for(int i = 0; i < alphabet.length(); i++){
        if(s == alphabet[i]) return i;
    }
    return 0;
}

void Encode(string txt, int addKey, int multKey){
    for(int i = 0; i < txt.length(); i++){
        cout.width(3);
        cout << alphabet[(keycode(txt[i]) * multKey + addKey) % alphabet.length()];
    }
}

void Decode(string txt, int addKey, int invMultKey){
    for(int i = 0; i < txt.length(); i++){
        cout.width(3);
        cout << alphabet[((keycode(txt[i]) - addKey + alphabet.length()) * invMultKey) % alphabet.length()];
    }
}

int main(){
    int addKey, multKey, invMultKey;
    string txt;
    char x;
    cout << "enter number encoding(1) or decoding(2)" << endl;
    cin >> x;
    
    if(x != '1' && x != '2'){
        cout << "value entered incorrectly" << endl;
        exit(0);
    }
    
    cout << "enter text: ";
    cin >> txt;
    
    // перевод в верхний регистр
    for(auto& c : txt) c = toupper(c);
    
    // аддитивный ключ
    cout << "\nenter additive key = ";
    cin >> addKey;
    if(addKey % alphabet.length() == 0){
        cout << "nothing to shifrate";
        return 0;
    }
    if(addKey < 0){
        addKey = addKey % alphabet.length();
    }
    
    // мультипликативный ключ
    bool a = true;
    while(a){
        cout << "enter multiplicative key = ";
        cin >> multKey;
        if(multKey < 0 || multKey > alphabet.length()){
            multKey = multKey % alphabet.length();
        }
        for(int i = 0; i < alphabet.length(); i++){
            if(multKey * i % alphabet.length() == 1){
                invMultKey = i;
                cout << "multiplicative key inversion = " << invMultKey << endl;
                a = false;
                break;
            }
        }
        if(a == true) cout << "no inversion input, try another key" << endl;
    }
    
    if(x == '1') Encode(txt, addKey, multKey);
    if(x == '2') Decode(txt, addKey, invMultKey);
    
}





