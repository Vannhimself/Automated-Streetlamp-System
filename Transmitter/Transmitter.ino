 #include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>

RF24 radio(4, 5); // CE, CSN         
const byte address[6] = "00001";
//int button_pin = 2;

void setup() {
  Serial.begin(9600);
  radio.begin();                  
  radio.openWritingPipe(address); 
  radio.setPALevel(RF24_PA_MIN);  
  radio.stopListening();
}

void loop(){
//  const char text[] = "ABCDEF";
  int id = 3;
  int batt = 280;
  float volt = (batt/4.092)/10;
  int ldr = 50;
  int panel = 220;
  float voltpanel = (panel/4.092)/10;
  
  String kata = String(id) + String(voltpanel) + String(volt) + String(ldr);
  char text[32] = "";
  
  for (int i = 0; i< kata.length(); i++){
      text[i] = kata[i];
  }

   
  if (radio.write(&text, sizeof(text))){
    Serial.println(text);
    Serial.println("Data Berhasil dikirim");
  } else Serial.println("Data Tidak Terkirim");
  
  delay(1000);
}
