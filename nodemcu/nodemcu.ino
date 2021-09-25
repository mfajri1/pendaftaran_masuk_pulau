#include <SoftwareSerial.h>
#include <MFRC522.h>
#include <SPI.h>
//library wifi
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>

LiquidCrystal_I2C lcd(0x27, 16, 2);

//Network SSID
const char* ssid = "empty";
const char* password = "makansamba1122";

//pengenal host (server) = IP Address komputer server
const char* host = "192.168.43.118";

//sediakan variabel untuk RFID
#define SDA_PIN 2  //D4
#define RST_PIN 0  //D3

MFRC522 mfrc522(SDA_PIN, RST_PIN);

String arrDataWeb[3];
int indexWeb = 0;
void setup() {
  
  Serial.begin(9600);
  lcd.begin();
  lcd.backlight();
  //setting koneksi wifi
  WiFi.hostname("NodeMCU");
  WiFi.begin(ssid, password);

  //cek koneksi wifi
  while(WiFi.status() != WL_CONNECTED)
  {
    //progress sedang mencari WiFi
    delay(500);
    Serial.print(".");
  }

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Selamat Datang");
  lcd.setCursor(0, 1);
  lcd.print("Fajri Mukhtar");

  delay(3000);
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Wifi Connected");
  lcd.setCursor(0, 1);
  lcd.print(WiFi.localIP());

  delay(2000);
  
//  Serial.println("Wifi Connected");
//  Serial.println("IP Address : ");
//  Serial.println(WiFi.localIP());

  SPI.begin();
  mfrc522.PCD_Init();
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Tempelkan Kartu");
  Serial.println("Dekatkan Kartu RFID Anda ke Reader");
  Serial.println();

}

void loop() {

  if(! mfrc522.PICC_IsNewCardPresent()){
     return ;
  }
  if(! mfrc522.PICC_ReadCardSerial()){
     return ;
  }
  // Dump debug info about the card; PICC_HaltA() is automatically called
  mfrc522.PICC_DumpToSerial(&(mfrc522.uid));
     
  String RFID = bacaRFID(); 
  
  //kirim nomor kartu RFID untuk disimpan ke tabel tmprfid
  WiFiClient client;
  const int httpPort = 80;
  if(!client.connect(host, httpPort))
  {
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Connection Failed");
    Serial.println("Connection Failed");
    return;
  }

  String Link;
  HTTPClient http;
  Link = "http://192.168.43.118/pulau/kirimkartu.php?nokartu=" + RFID;
  http.begin(Link);

  int httpCode = http.GET();
  String payload = http.getString();
  Serial.println(payload);
//  for(int i = 0; i <= payload.length(); i++){
//    char delimiter = '-';
//    if(payload[i] != delimiter){
//       arrDataWeb[indexWeb] += payload[i];  
//    }else{
//      indexWeb++;  
//    }  
//  }
  if(payload == "kosong"){
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Kartu Anda");
    lcd.setCursor(0, 1);
    lcd.print("Belum Terdaftar");
    delay(2000);
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Silahkan");
    lcd.setCursor(0, 1);
    lcd.print("Mendaftar Dahulu");
    Serial.println("Anda Belum Terdaftar");
    delay(3000);
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Tempelkan Kartu");
    payload = "";
  }else if(payload == "keluar"){
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Terima Kasih");
    lcd.setCursor(0, 1);
    lcd.print("Atas Kunjungannya");
    Serial.println("Terima kasih atas kunjungan nya");
    delay(3000);
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Tempelkan Kartu");
    payload = "";
  }else if(payload == "penuh"){
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Mohon Maaf");
    lcd.setCursor(0, 1);
    lcd.print("Pulau Penuh !!!");
    Serial.println("Mohon Maaf, pengunjung penuh");
    delay(3000);
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Tempelkan Kartu");
    payload = "";
  }else if(payload == "masuk"){
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Terima kasih");
    lcd.setCursor(0, 1);
    lcd.print("Silahkan Masuk");
    Serial.println(" Silahkan Masuk");
    delay(3000);
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Tempelkan Kartu");
    payload = "";
  }
  
  http.end();
  
  delay(2000);
}

String bacaRFID(){
  String IDTAG = "";
  for(byte i=0; i<mfrc522.uid.size; i++)
  {
    IDTAG += mfrc522.uid.uidByte[i];
  }
  return IDTAG;
}
