<?php header("Content-Type: text/xml; charset=utf-8");
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>"; ?>
<definitions xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
             xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/"
             xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
             xmlns:mime="http://schemas.xmlsoap.org/wsdl/mime/"
             xmlns:tns="http://localhost/"
             xmlns:xs="http://www.w3.org/2001/XMLSchema"
             xmlns:soap12="http://schemas.xmlsoap.org/wsdl/soap12/"
             xmlns:http="http://schemas.xmlsoap.org/wsdl/http/"
             name="MyServiceWsdl"
             xmlns="http://schemas.xmlsoap.org/wsdl/"
			 targetNamespace="http://localhost/">
	<!-- Типы данных, используемые в качестве аргументов и возвращаемых значений -->
	<types>
		<xs:schema elementFormDefault="qualified"
                   xmlns:tns="http://localhost/"
                   xmlns:xs="http://www.w3.org/2001/XMLSchema"
                   targetNamespace="http://localhost/">				   
				    <xs:element name="MyFirstProc_Request">					
						<xs:complexType>
							<!--Объявление формата аргументов сервиса-->
						</xs:complexType>
					</xs:element>
					<xs:element name="MyFirstProc_Response">					
						<xs:complexType>
							<xs:sequence>
								<xs:element name="answer" type="xs:string" minOccurs="1" maxOccurs="1"/>
							</xs:sequence>
							<!--Объявление формата возвращаемого значения-->							
						</xs:complexType>
					</xs:element>

				    <xs:element name="MyProcArgs_Request">					
						<xs:complexType>
							<!--Объявление формата аргументов сервиса-->
							<xs:sequence>
								<xs:element name="myint" type="xs:int"
											minOccurs="1" maxOccurs="1" />
								<xs:element name="mystring" type="xs:string"
											minOccurs="1" maxOccurs="1" />
								<xs:element name="myarray" type="xs:string"
											minOccurs="1" maxOccurs="3" />
								<xs:element name="mystruct" type="xs:mystructdef"
											minOccurs="1" maxOccurs="1" />
							</xs:sequence>
						</xs:complexType>
					</xs:element>
					<xs:complexType name="mystructdef">
						<xs:sequence>
								<xs:element name="field1" type="xs:string"
											minOccurs="1" maxOccurs="1" />
								<xs:element name="field2" type="xs:int"
											minOccurs="1" maxOccurs="1" />

							</xs:sequence>
					</xs:complexType>
					<xs:element name="MyProcArgs_Response">					
						<xs:complexType>
							<xs:sequence>
								<xs:element name="answer" type="xs:string" minOccurs="1" maxOccurs="1"/>
							</xs:sequence>
							<!--Объявление формата возвращаемого значения-->							
						</xs:complexType>
					</xs:element>
					
		 </xs:schema>
	</types>
	<!-- Сообщения процедуры  -->
    <message name="MyFirstProc_RequestMessage">
        <part name="parameters" element="tns:MyFirstProc_Request" />
    </message>
    <message name="MyFirstProc_ResponseMessage">
        <part name="parameters" element="tns:MyFirstProc_Response" />
    </message>	
	
	<message name="MyProcArgs_RequestMessage">
        <part name="parameters" element="tns:MyProcArgs_Request" />
    </message>
    <message name="MyProcArgs_ResponseMessage">
        <part name="parameters" element="tns:MyProcArgs_Response" />
    </message>	
	
	 <!-- Привязка процедуры к сообщениям -->
    <portType name="MyServicePortType">
        <operation name="MyFirstProc">
            <input message="tns:MyFirstProc_RequestMessage" />
            <output message="tns:MyFirstProc_ResponseMessage" />
        </operation>
        <operation name="MyProcArgs">
            <input message="tns:MyProcArgs_RequestMessage" />
            <output message="tns:MyProcArgs_ResponseMessage" />
        </operation>
		
    </portType>
	<!--Формат процедур веб-сервиса -->
    <binding name="MyServiceBinding" type="tns:MyServicePortType">
        <soap:binding transport="http://schemas.xmlsoap.org/soap/http" />
		<!--Объявление списка процедур-->
        <operation name="MyFirstProc">
            <soap:operation soapAction="" />
            <input>
                <soap:body use="literal" />
            </input>
            <output>
                <soap:body use="literal" />
            </output>
        </operation>
        <operation name="MyProcArgs">
            <soap:operation soapAction="" />
            <input>
                <soap:body use="literal" />
            </input>
            <output>
                <soap:body use="literal" />
            </output>
        </operation>
    </binding>
	<!--Определение сервиса -->
    <service name="MyService">
        <port name="MyServicePort" binding="tns:MyServiceBinding">
            <soap:address location="http://localhost:80/soap/server.php"/>
        </port>
    </service>
</definitions>