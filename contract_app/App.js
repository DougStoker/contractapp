/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 *
 * @format
 * @flow strict-local
 */

import React from 'react';
import {
  SafeAreaView,
  StyleSheet,
  ScrollView,
  View,
  Text,
  StatusBar,
} from 'react-native';

import {
  Header,
  LearnMoreLinks,
  Colors,
  DebugInstructions,
  ReloadInstructions,
} from 'react-native/Libraries/NewAppScreen';

getdata = () => {
    return fetch(
        'http://localhost:8000/connector.php', 
        {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            // body: JSON.stringify({
            
            //     name: UserName,
            
            //     email: UserEmail,
            
            //     password: UserPassword,
            
            // })
        }
    )
}


//let data = ['...', '...', '...', '...', '...', '...', '...'];

// let datap = getdata()


//const data = await datap;

const getDataAsync = async () => {
    try {
        let response = await fetch(
            'http://192.168.1.1:8000/connector.php'
            );
            let json = await response.json();
            return json;
        } catch (error) {
            console.error(error);
        }
};
    
let data = getDataAsync()


const Tile = (t) => {
  return(
    <>
        <View style = {styles.tiles} ><Text>{t}</Text></View>
    </>
    );
};

const TileArray = () => {
    let a = []
    for(d of getDataAsync()){
        a.push(Tile(JSON.stringify(d)));
    }
    return a;
}




const App: () => React$Node = () => {
    console.warn(data)
  return (
    <>
      <StatusBar barStyle="dark-content" />
      <SafeAreaView>
        <ScrollView
          contentInsetAdjustmentBehavior="automatic"
          style={styles.scrollView}>
          <Header />
          {global.HermesInternal == null ? null : (
            <View style={styles.engine}>
              <Text style={styles.footer}>Engine: Hermes</Text>
            </View>
          )}
          <View style={styles.body}>
            <TileArray></TileArray>   
          </View>
        </ScrollView>
      </SafeAreaView>
    </>
  );
};

const styles = StyleSheet.create({
  tiles: {
    backgroundColor: Colors.light,
    width: '90%',
    borderRadius: 10,
    margin: 10,
  },
  scrollView: {
    backgroundColor: Colors.lighter,
  },
  engine: {
    position: 'absolute',
    right: 0,
  },
  body: {
    backgroundColor: Colors.white,
  },
  sectionContainer: {
    marginTop: 32,
    paddingHorizontal: 24,
  },
  sectionTitle: {
    fontSize: 24,
    fontWeight: '600',
    color: Colors.black,
  },
  sectionDescription: {
    marginTop: 8,
    fontSize: 18,
    fontWeight: '400',
    color: Colors.dark,
  },
  highlight: {
    fontWeight: '700',
  },
  footer: {
    color: Colors.dark,
    fontSize: 12,
    fontWeight: '600',
    padding: 4,
    paddingRight: 12,
    textAlign: 'right',
  },
});

export default App;
