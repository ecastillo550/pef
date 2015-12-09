package org.talend;

import pefbi.dimcustomerprueba_0_1.dimcustomerprueba;
import java.io.*;
import java.net.*;

public class talendLauncher {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		//dimcustomerprueba talendJob = new dimcustomerprueba();
		//talendJob.runJob(new String[]{});
		
		String clientSentence;
        String capitalizedSentence;
        ServerSocket welcomeSocket;
		try {
			welcomeSocket = new ServerSocket(8081);
			while(true)
	        {
	           Socket connectionSocket = welcomeSocket.accept();
	           BufferedReader inFromClient =
	              new BufferedReader(new InputStreamReader(connectionSocket.getInputStream()));
	           //DataOutputStream outToClient = new DataOutputStream(connectionSocket.getOutputStream());
	           clientSentence = inFromClient.readLine();
	           System.out.println("Received: " + clientSentence);
	           if(clientSentence.equalsIgnoreCase("leer")) {
	        	   System.out.println("Ejecutando Jobs");
	        	   dimcustomerprueba talendJob = new dimcustomerprueba();
	        	   talendJob.runJob(new String[]{});
	           }
	           capitalizedSentence = clientSentence.toUpperCase() + '\n';
	           //outToClient.writeBytes(capitalizedSentence);
	           connectionSocket.close(); //this line was part of the solution
	        }
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

        
		
	}

}
