#include <SPI.h>
#include <MFRC522.h>

#define RST_PIN         D3          // Configurable, see typical pin layout above
#define SS_1_PIN        D2         // Configurable, take a unused pin, only HIGH/LOW required, must be different to SS 2

#define NR_OF_READERS   1

byte ssPins[] = {SS_1_PIN};

MFRC522 mfrc522[NR_OF_READERS];   // Create MFRC522 instance.

String UID;

void setup() {

  Serial.begin(115200); // Initialize serial communications with the PC
  Serial1.begin(115200);
  while (!Serial);    // Do nothing if no serial port is opened (added for Arduinos based on ATMEGA32U4)

  SPI.begin();        // Init SPI bus

  for (uint8_t reader = 0; reader < NR_OF_READERS; reader++) {
    mfrc522[reader].PCD_Init(ssPins[reader], RST_PIN); // Init each MFRC522 card
    Serial.print(F("Reader "));
    Serial.print(reader);
    Serial.print(F(": "));
    mfrc522[reader].PCD_DumpVersionToSerial();
  }
}

void loop() {
  readCard();
}

void readCard() {
  for (uint8_t reader = 0; reader < NR_OF_READERS; reader++) {
    if (mfrc522[reader].PICC_IsNewCardPresent() && mfrc522[reader].PICC_ReadCardSerial()) {
      getUID(mfrc522[reader].uid.uidByte, mfrc522[reader].uid.size);

      // Halt PICC
      mfrc522[reader].PICC_HaltA();
      mfrc522[reader].PCD_StopCrypto1();
    }
  }
}

void getUID(byte *buffer, byte bufferSize) {
  UID = "";
  for (byte i = 0; i < bufferSize; i++) {
    UID.concat(String(buffer[i] < 0x10 ? " 0" : " "));
    UID.concat(String(buffer[i], HEX));
  }

  Serial.print(F("Card UID:"));
  Serial.println(UID);
  
  Serial1.println(UID);
}
