/*
 * 
 * 
 * programme principale get data from dht11 and send it
 * 
 * 
 * 
 */

#include <SPI.h>
#include <WiFi.h>

// Integration de DHT22
#include "DHT.h"   // Librairie des capteurs DHT
#define DHTPIN A0    // Changer le pin sur lequel est branché le DHT
// Dé-commentez la ligne qui correspond à votre capteur 
#define DHTTYPE DHT11     // DHT 11 
//#define DHTTYPE DHT22       // DHT 22  (AM2302)
//#define DHTTYPE DHT21     // DHT 21 (AM2301)
DHT dht(DHTPIN, DHTTYPE); 



char ssid[] = "G3i3K";      //  your network SSID (name)
char pass[] = "azerty123";   // your network password
int keyIndex = 0;            // your network key Index number (needed only for WEP)

int status = WL_IDLE_STATUS;
int marche_moteur = 8;
int a = 1;
// Initialize the Wifi client library
WiFiClient client;

// server address:
char server[] = "climacap.000webhostapp.com";
//IPAddress server(64,131,82,241);

unsigned long lastConnectionTime = 0;            // last time you connected to the server, in milliseconds
const unsigned long postingInterval = 10L * 1000L; // delay between updates, in milliseconds
  String moteur = String(); // store temperature from database
    String temperature = String();
void setup() {
  //Initialize serial and wait for port to open:
  Serial.begin(9600);
 dht.begin();


    pinMode(marche_moteur, OUTPUT);
  while (!Serial) {
    ; // wait for serial port to connect. Needed for native USB port only
  }

  // check for the presence of the shield:
  if (WiFi.status() == WL_NO_SHIELD) {
    Serial.println("WiFi shield not present");
    // don't continue:
    while (true);
  }

  String fv = WiFi.firmwareVersion();
  if (fv != "1.1.0") {
    Serial.println("Please upgrade the firmware");
  }

  // attempt to connect to Wifi network:
  while (status != WL_CONNECTED) {
    Serial.print("Attempting to connect to SSID: ");
    Serial.println(ssid);
    // Connect to WPA/WPA2 network. Change this line if using open or WEP network:
    status = WiFi.begin(ssid, pass);

    // wait 10 seconds for connection:
    delay(10000);
  }
  // you're connected now, so print out the status:
  printWifiStatus();
}

void loop() {
  String content = String(); // store temperature from database

  // Délai de 2 secondes entre chaque mesure. La lecture prend 250 millisecondes
  delay(2000);

  // Lecture du taux d'humidité
  float hdht = dht.readHumidity();
  // Lecture de la température en Celcius
  float tdht = dht.readTemperature();


  // Stop le programme et renvoie un message d'erreur si le capteur ne renvoie aucune mesure
  if (isnan(hdht) || isnan(tdht)) {
    Serial.println("Echec de lecture !");
    return;
  }


  Serial.print("Humidite DHT22 : "); 
  Serial.print(hdht);
  Serial.print(" %\t");
  Serial.print("Temperature DHT22 : "); 
  Serial.print(tdht);
  Serial.print(" *C ");

  


              
  // if there's incoming data from the net connection.
  // send it out the serial port.  This is for debugging
  // purposes only:
  while (client.available()) {
      char c = client.read();   // Read one byte 
      String tmp = String(c);   // Make it to a string
      content += tmp;           // Add it to the result string
                   //Serial.write(c);
 
  }

  
//Serial.print(content);
          for(int i=0;i<1000;i++)
          {
           if(content[i]=='~')
           {
             String p=String(content[i+1]);
              String pp=String(content[i+2]);
              temperature=p+pp; 
              
           }
          }
           //Serial.print("temperature: ");
           Serial.print(temperature);
           
          for(int j=0;j<1000;j++)
          {
           if(content[j]=='|')
           {
             moteur=String(content[j+1]);
           
           }
          }
Serial.print(moteur);



            if(moteur=="1"){
            
             digitalWrite(marche_moteur, HIGH);   
             }
            else if(moteur=="0")
            {//condition temperature
               int x = temperature.toInt();
               Serial.print("to int  ");
              Serial.print(temperature);
                 if(tdht>=x) // moteur marcher si temperature tdht de dht11 > temperature par defaut temperature
                {
                  digitalWrite(marche_moteur, HIGH);
                   
                  }
                else
                {digitalWrite(marche_moteur, LOW);  } 
           
              }          
              

  // if ten seconds have passed since your last connection,
  // then connect again and send data:
  if (millis() - lastConnectionTime > postingInterval) {
    httpRequest();

  }

}

// this method makes a HTTP connection to the server:
void httpRequest() {
  // close any connection before send a new request.
  // This will free the socket on the WiFi shield
client.stop();

  // if there's a successful connection:
  if (client.connect(server, 80)) {
    Serial.println("connecting...");
    // send the HTTP PUT request:
    client.println("GET /get_temperature.php HTTP/1.1");
    client.println("Host: climacap.000webhostapp.com");
    client.println("User-Agent: ArduinoWiFi/1.1");
    client.println("Connection: close");
    client.println();

    // note the time that the connection was made:
    lastConnectionTime = millis();
  } else {
    // if you couldn't make a connection:
    Serial.println("connection failed");
  }
}


void printWifiStatus() {
  // print the SSID of the network you're attached to:
  Serial.print("SSID: ");
  Serial.println(WiFi.SSID());

  // print your WiFi shield's IP address:
  IPAddress ip = WiFi.localIP();
  Serial.print("IP Address: ");
  Serial.println(ip);

  // print the received signal strength:
  long rssi = WiFi.RSSI();
  Serial.print("signal strength (RSSI):");
  Serial.print(rssi);
  Serial.println(" dBm");
}


