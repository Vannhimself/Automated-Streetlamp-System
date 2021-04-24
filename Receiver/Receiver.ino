#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>

RF24 radio(4,5); // CE, CSN
const byte address[6] = "00001";

void setup() {
  Serial.begin(9600);
  radio.begin();
  radio.openReadingPipe(0, address);   //Setting the address at which we will receive the data
  radio.setPALevel(RF24_PA_MIN);       //You can set this as minimum or maximum depending on the distance between the transmitter and receiver.
  radio.startListening();              //This sets the module as receiver
}

void loop(){
  if (radio.available()){
    char text[32] = "";                 //Saving the incoming data
    radio.read(&text, sizeof(text));    //Reading the data
    String id = (String)text[0];
    String panel = (String)text[1] + (String)text[2] + (String)text[3] + (String)text[4];
    String batt = (String)text[5] + (String)text[6] + (String)text[7] + (String)text[8];

    if((String)text[11] == (String)text[11]){
      String ldr = (String)text[9] + (String)text[10] + (String)text[11];
      Serial.print("id lampu :");
      Serial.println(id);
  
      Serial.print("baterai lampu :");
      Serial.println(batt);
  
      Serial.print("ldr lampu :");
      Serial.println(ldr);
  
      Serial.print("panel surya :");
      Serial.println(panel);
    } else {
      String ldr = (String)text[9] + (String)text[10];
      Serial.print("id lampu :");
      Serial.println(id);
  
      Serial.print("baterai lampu :");
      Serial.println(batt);
  
      Serial.print("ldr lampu :");
      Serial.println(ldr);
  
      Serial.print("panel surya :");
      Serial.println(panel);  
    }
    
    delay(1000);
  }
} 
