#define wAir 25
#define wSabun 27
#define infraAir 31
#define infraSabun 33

int dataInfraAir,dataInfraSabun;

void setup() {
  Serial.begin(9600);
  pinMode(wAir, OUTPUT);
  pinMode(wSabun, OUTPUT);
  pinMode(infraAir, INPUT);
  pinMode(infraSabun, INPUT);
  digitalWrite(wAir, HIGH);
  digitalWrite(wSabun, HIGH);

}

void loop() {
  dataInfraAir = digitalRead(infraAir);
  Serial.println(dataInfraAir);
  if(dataInfraAir == LOW){
    Serial.println("aktif");
    digitalWrite(wAir, LOW);
    delay(5000);
    digitalWrite(wAir, HIGH);
//    cuciSabun();
  }

  dataInfraSabun = digitalRead(infraSabun);
    if(dataInfraSabun == LOW){
      Serial.println("aktif oi");
      digitalWrite(wSabun, LOW);
      delay(3000);
      digitalWrite(wSabun, HIGH);
//      cuciTangan();
//      return;
    }  
}

void cuciTangan(){
  dataInfraAir = digitalRead(infraAir);
  Serial.println(dataInfraAir);
  if(dataInfraAir == LOW){
    Serial.println("aktif");
    digitalWrite(wAir, LOW);
    delay(5000);
    digitalWrite(wAir, HIGH);
  }
}

void cuciSabun(){
  while(1){
    dataInfraSabun = digitalRead(infraSabun);
    if(dataInfraSabun == LOW){
      Serial.println("aktif oi");
      digitalWrite(wSabun, LOW);
      delay(3000);
      digitalWrite(wSabun, HIGH);
//      cuciTangan();
      return;
    }  
  }
  
}
