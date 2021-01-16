/*
 * 
 * 
 * programme principale send to database loop
 * 
 * 
 */
#include <SPI.h>
#include <WiFi.h>

char ssid[] = "G3i3K";      //  your network SSID (name)
char pass[] = "azerty123";   // your network password
int keyIndex = 0;            // your network key Index number (needed only for WEP)

int status = WL_IDLE_STATUS;

// Initialize the Wifi client library
WiFiClient client_temp; // temperature
WiFiClient client_humd; //humididte
// server address:
char server[] ="climacap.000webhostapp.com" ; // This could alsgo be 192.168.1.18/~me if you are running a server on your computer on a local network.

// This is the data that will be passed into your POST and matches your mysql column
int temp_input =99;
String temp_col ="temp=";
String temp;

int humd_input =36;
String humd_col ="humd=";
String humd;

unsigned long lastConnectionTime = 0;            // last time you connected to the server, in milliseconds
const unsigned long postingInterval = 10L * 1000L; // delay between updates, in milliseconds

void setup() {
  //Initialize serial and wait for port to open:
  Serial.begin(9600);
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
    delay(3000);
  }
  // you're connected now, so print out the status:
  printWifiStatus();
}

void loop() {
  // if there's incoming data from the net connection.
  // send it out the serial port.  This is for debugging
  // purposes only:
  while (client_temp.available()) {
    char c = client_temp.read();
   // Serial.write(c);
  }

while (client_humd.available()) {
    char c = client_humd.read();
   // Serial.write(c);
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
  client_temp.stop();
  client_humd.stop();
  
  // if there's a successful connection:
  if (client_temp.connect(server, 80)) {
    Serial.println("connecting...");
    // send the HTTP PUT request:
    
   temp = temp_col + temp_input;
    client_temp.println("POST /posttemp.php HTTP/1.1");
    client_temp.println("Host: climacap.000webhostapp.com");
    client_temp.println("User-Agent: ArduinoWiFi/1.1");
    client_temp.println("Connection: close");
   client_temp.println("Content-Type: application/x-www-form-urlencoded;");
    client_temp.print("Content-Length: ");
    client_temp.println(temp.length());
    client_temp.println();
    client_temp.println(temp);
    if(client_temp.println(temp))
     {Serial.println("temp sent ok");
     Serial.println(temp);
      }
  }else {
    // if you couldn't make a connection:
    Serial.println("connection client_temp failed");
  }
// if there's a successful connection:
  if (client_humd.connect(server, 80)) {
    Serial.println("connecting...");
    // send the HTTP PUT request:
      humd = humd_col + humd_input;
    client_humd.println("POST /posthum.php HTTP/1.1");
    client_humd.println("Host: climacap.000webhostapp.com");
    client_humd.println("User-Agent: ArduinoWiFi/1.1");
    client_humd.println("Connection: close");
   client_humd.println("Content-Type: application/x-www-form-urlencoded;");
    client_humd.print("Content-Length: ");
    client_humd.println(humd.length());
    client_humd.println();
    client_humd.println(humd);
    if(client_humd.println(humd))
     {Serial.println("humd sent ok");
     Serial.println(humd);
      }
      
    // note the time that the connection was made:
    lastConnectionTime = millis();
  } else {
    // if you couldn't make a connection:
    Serial.println("connection client_hum failed");
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
